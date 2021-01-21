;(function($, BA_PLUGIN) {

    'use strict';

    var $tabsNav = $('.ba-nav').find('.ba-tabs-nav'),
        $tabsContent = $('.ba-admin-tabs').find('.ba-admin-tabs-content');

    $tabsNav.on('click', '.ba-admin-nav-item-link', function(e) {     
        console.log('work!');
        var $currentTab = $(e.currentTarget),
            tabTargetHash = e.currentTarget.hash,
            tabIdSelector = '#tab-content-' + tabTargetHash.substring(1),
            $currentTabContent = $tabsContent.find(tabIdSelector);

        e.preventDefault();

        $currentTab
            .addClass('active-tab')
            .siblings()
            .removeClass('active-tab');

        $currentTabContent
            .addClass('active-tab')
            .siblings()
            .removeClass('active-tab');

        window.location.hash = tabTargetHash;
    });

    if (window.location.hash) {
        $tabsNav.find('a[href="'+window.location.hash+'"]').click();
    }

	var $adminForm = $('#ba-admin-modules-form'),
	    $saveButton = $adminForm.find('.ba-btn-save');

    $adminForm.on('submit', function(e) {
        e.preventDefault();
        $.post({
            url: BA_PLUGIN.ajaxUrl,
            data: {
                nonce: BA_PLUGIN.nonce,
                action: BA_PLUGIN.action,
                data: $adminForm.serialize()
            },

            beforeSend: function() {
                $saveButton.text('Saving...');
            },

            success: function(response) {
                if ( response.success ) {
                    var t = setTimeout(function () {
                        $saveButton
                            .attr('disabled', true)
                            .text('Changes Saved');
                        clearTimeout(t);
                    }, 500);
                }
            }
        });
    });

    $adminForm.on('change', ':checkbox, :radio', function() {
        $saveButton.attr('disabled', false).text('Save Changes');
    });

    $adminForm.on('change', ':text', function() {
        $saveButton.attr('disabled', false).text('Save Changes');
    });

    $( '.ba-ext-switch' ).on( 'click', function () {
        console.log('work!');
    });

}(jQuery, window.BA_PLUGIN));