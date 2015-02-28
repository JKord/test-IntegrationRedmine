var App = {

    init: function (callback) {
        if (callback !== undefined) {
            callback();
        }
    },

    issuesByTracker: function(projectId, panel) {
        var  panelBody = panel.find('.panel-body'), list = panelBody.find('.list-group');
        preloader.on();
        //panelBody.addClass('close');
        $.get('/projects/' + projectId + '/issues?trackerId='+panel.data('id')+'&page='+panelBody.data('page'), function(data) {
            if (data.code == 1) {
                panelBody.removeClass('close');
                panelBody.data('pageLast', data.pageLast);
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
            panelBody.data('page', 1);
            list.html('');
            e.stopPropagation();
        });
        $('#trackers').on('click', '.btn-group button', function() {
            var panelBody = $(this).parent().parent(), page = parseInt(panelBody.data('page'));
            if($(this).attr('id') == 'next') {
                if(panelBody.data('pageLast')) return;
                page++;
            } else {
                if(1 == page) return;
                page--;
            }
            panelBody.data('page', page.toString());
            self.issuesByTracker(projectId, panelBody.parent());
        });
    },

    commentsUpdate: function(projectId) {
        var list = $('#commentsList'), commentsHtml = '';
        $.get('/projects/' + projectId + '/comments', function(data) {
            if (data.code == 1) {
                if(data.comments.length > 0) {
                    $.each(data.comments, function(i, comment) {
                        commentsHtml += ' <li class="list-group-item"><span class="badge">'+comment.authorName+'</span><p>'+comment.text+'</p></li>';
                    });
                } else {
                    commentsHtml = '<li class="list-group-item">Коментарі відсутні</li>';
                }
                list.html(commentsHtml);
            } else {
                MessageApp.show(data);
            }
            preloader.off('disabled');
        });
    },
    commentAdd: function(projectId, text) {
        var self = this, list = $('#commentsList');
        preloader.on();
        $.ajax({ url: '/projects/' + projectId + '/comments/add', type: 'PUT', data: { text: text },
            success: function(data) {
                if (data.code == 1) {
                    self.commentsUpdate(projectId);
                } else {
                    MessageApp.show(data);
                    preloader.off('disabled');
                }
            }
        });
    },
    commentsShow: function(project) {
        var self = this;
        BootstrapDialog.show({
            title: 'Коментарі до ' + project.name,
            message: ' <ul class="list-group" id="commentsList"></ul>',
            buttons: [
                { label: 'Додати коментар', action: function(d) { self.commentAdd(project.id, prompt("Текст коментаря", "")); }},
                { label: 'Закрити', action: function(d) { d.close(); } },
            ],
            onshow: function(d) {
                preloader.on();
                setTimeout(function() {
                    self.commentsUpdate(project.id);
                }, 300);
            }
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