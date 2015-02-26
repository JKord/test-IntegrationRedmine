var App = {
    test: null,

    init: function (callback) {
        if (callback !== undefined) {
            callback();
        }
    }
};

var MessageApp = {
    show: function(msg){
        alert(msg.message);
    }
};