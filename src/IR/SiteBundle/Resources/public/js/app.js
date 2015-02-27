var App = {
    init: function (callback) {
        if (callback !== undefined) {
            callback();
        }
    },

    issuesByTracker: function(projectId, panel) {
        var  panelBody = panel.find('.panel-body'), list = panelBody.find('.list-group');
        preloader.on();
        panelBody.addClass('close');
        $.get('/projects/' + projectId + '/issues?trackerId=' + panel.data('id'), function(data) {
            if (data.code == 1) {
                panelBody.removeClass('close');
                list.html(data.issuesHtml);
            } else {
                list.html('');
                MessageApp.show(data);
            }
            preloader.off('disabled');
        });
    },
    bindIssues: function(projectId) {
        var self = this;
        $('#trackers').on('click', '.panel-heading', function() {
            self.issuesByTracker(projectId, $(this).parent());
        });
        $('#trackers').on('click', '.panel-heading .closePanel', function(e) {
            var panelBody = $(this).parent().parent().parent().find('.panel-body'), list = panelBody.find('.list-group');
            panelBody.addClass('close');
            list.html('');
            e.stopPropagation();
        });
    }
};

var MessageApp = {
    show: function(msg){
        alert(msg.message);
    }
};

var preloader = new $.materialPreloader({
    position: 'top',
    height: '5px',
    col_1: '#159756',
    col_2: '#da4733',
    col_3: '#3b78e7',
    col_4: '#fdba2c',
    fadeIn: 200,
    fadeOut: 200
});