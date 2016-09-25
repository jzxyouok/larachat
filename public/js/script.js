var socket = io.connect('http://127.0.0.1:8890');
var session = window.session_id;
/*begin vue js*/
Vue.config.delimiters = ['${', '}']
Vue.http.interceptors.push(function (request, next) {
    request.headers['X-CSRF-TOKEN'] = Laravel.csrfToken;
    next();
});

new Vue({
    el: "#appkini",
    data: {
        messages: [],
        newMessage: "",
        token: document.querySelector('meta[role=token]').content,
        userId: null,
        rooms: [],
        room: "default_room",
        notifications: [],
        closeTriggers: document.querySelectorAll('.fout'),
        showPrivateMessages: 0
    },

    ready: function ready() {
        this.loadMessages();
        this.initListener();
        this.loadRooms();
        this.setUser();
    },

    methods: {
        sendMessage: function sendMessage(e) {
            e.preventDefault();
            if (this.newMessage == "") return;
            var that = this;

            $.post('/messages', { _token: this.token, room_id: this.room, message: this.newMessage }).done(function () {
                that.newMessage = "";
            });
        },

        answer: function answer(msg) {
            this.newMessage = '#' + msg.author.name + ', ';
            this.$els.input.focus();
        },

        initListener: function initListener() {
            var that = this;

            socket.on(that.room, function (msg) {
                if (msg.room_id == that.room) {
                    that.messages.push(msg);
                } else if (msg.room != that.room && msg.to == that.user.id) {
                    that.notifications.push(msg);
                    that.initCloseAlertTriggers();
                }
                that.scrollBottom();
            });

            socket.on('messageHasBeenDeleted', function (msgId) {
                var msg = _.findWhere(that.messages, { id: msgId });
                that.messages.$remove(msg);
            });

            socket.on('roomHasBeenDeleted', function (roomId) {
                var room = _.findWhere(that.rooms, { id: roomId });
                that.rooms.$remove(room);
                if (that.room == roomId) {
                    that.changeRoom(0);
                    that.notifications.push({
                        author: { name: 'System' },
                        message: 'К сожалению, комната в которой вы находитесь удалена. ' + 'Вы перенаправлены в комнату по умолчанию'
                    });
                    that.initCloseAlertTriggers();
                }
            });

            socket.on('roomHasBeenCreated', function (room) {
                that.rooms.push(room);
            });
        },

        loadMessages: function loadMessages() {
            var that = this;
            $.ajax({
                url: '/messages',
                method: 'GET',
                data: { room: that.room, showPrivate: that.showPrivateMessages },
                cache: false
            }).done(function (messages) {
                that.messages = messages;
            });
        },

        remove: function remove(msg) {
            $.post('/messages/' + msg.id, { _token: this.token, _method: 'DELETE' }).done(function () {
                socket.emit('delete', msg);
            });
        },

        loadRooms: function loadRooms() {
            var that = this;
            $.ajax({
                url: '/rooms',
                method: 'GET'
            }).done(function (rooms) {
                that.rooms = rooms;
            });
        },

        changeRoom: function changeRoom(roomId) {
            var that = this;
            this.room = roomId;
            that.loadMessages();
            $.post('/users/set_room', { _token: this.token, room: roomId }).done(function () {
                that.scrollBottom();
            });
        },

        removeRoom: function removeRoom(roomId) {
            var that = this;
            $.post('/rooms/' + roomId, { _token: this.token, _method: "DELETE" }).done(function () {
                socket.emit('deleteRoom', roomId);
            });
        },

        setUser: function setUser() {
            var that = this;
            $.ajax({
                url: "/users/get_user",
                method: 'GET',
                cache: false
            }).done(function (user) {
                that.user = user;
                socket.emit('register', user);
            });
        },

        scrollBottom: function scrollBottom() {
            var messageBox = this.$els.msgs;
            $(messageBox).animate({ 'scrollTop': messageBox.scrollHeight }, 'slow');
        },

        initCloseAlertTriggers: function initCloseAlertTriggers() {
            setTimeout(function () {
                $('.fout').click(function () {
                    $(this).closest('.alert').fadeOut('fast');
                });
            }, 300);
        },

        showPrivate: function showPrivate() {
            this.showPrivateMessages = 1;
            this.loadMessages();
        },

        hidePrivate: function hidePrivate() {
            this.showPrivateMessages = 0;
            this.loadMessages();
        },

        messageClass: function messageClass(msg) {
            if (msg.to == this.user.id) return 'privateMsg';
            if (msg.user_id == this.user.id) return 'myMsg';
        },

        createRoom: function createRoom() {
            var that = this;
            $.post('/rooms', { _token: this.token, title: this.$els.room.value }).done(function (room) {
                socket.emit('createRoom', room);
                that.$els.room.value = '';
            });
        }

    }

});