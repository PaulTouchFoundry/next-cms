/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/XtN0RS by Jason Garber
 * ======================================================================== */

SITENAME = {

    common: {

        init: function ()
        {
            /*
             * Check to see if the current browser supports DOM level 2 events e.g. `addEventListener`.
             * Internet Explorer 8 and below does not.
             * Based on: http://responsivenews.co.uk/post/18948466399/cutting-the-mustard
             */

            var isModernBrowser = ('addEventListener' in window) ? true : false;

            /* ==========================================================================
               Accordion
               ========================================================================== */

            var $accordion_component = $('.js-accordion');
            var accordionHideFunc = function (e)
            {
                if (e !== undefined && $(this).attr('href') !== undefined) {
                    e.preventDefault();
                }

                var $link = $(this);
                if (!$link.hasClass('accordion-item__link')) {
                    $link = $link
                            .parent()
                            .parent()
                            .parent()
                            .find('.accordion-item__link');
                }
                var $item = $link.parents('.accordion-item');
                var $icon = $('.icon', $link);
                var icon_up = $link.data('icon-up');
                var icon_down = $link.data('icon-down');

                /*
                 * Update the selected accordion item
                 */

                if ($item.hasClass('is-selected'))
                {
                    $item.removeClass('is-selected');
                    $item.attr('aria-hidden', 'true').attr('aria-selected', 'false');
                    $icon.removeClass(icon_up).addClass(icon_down);
                }
                else
                {
                    $item.addClass('is-selected');
                    $item.attr('aria-hidden', 'false').attr('aria-selected', 'true');
                    $icon.removeClass(icon_down).addClass(icon_up);
                }
            };

            if ($accordion_component.length > 0)
            {
                $(document).on('click', '.accordion-item__link', accordionHideFunc);
            }

            /* ==========================================================================
               Alert
               ========================================================================== */

            var $alert_component = $('.js-alert');

            if ($alert_component.length > 0)
            {
                $alert_component.each(function ()
                {
                    var $alert = $(this);

                    var $dismiss_alert = $('.js-dismiss', $alert);

                    $dismiss_alert.on('click', function (e)
                    {
                        e.preventDefault();

                        $alert.fadeOut();
                    });
                });
            }

            /* ==========================================================================
               Character Counter
               ========================================================================== */

            var $character_counter = $('.js-character-counter');

            if ($character_counter.length > 0)
            {
                $character_counter.each(function ()
                {
                    var $counter = $(this);
                    var $counter_output = $('.js-character-counter-output');
                    var limit = $counter.attr('maxlength');

                    $counter.on('keyup', function ()
                    {
                        $counter_output.text(limit - $(this).val().length);
                    });
                });
            }

            /* ==========================================================================
               Icons List
               ========================================================================== */

            var $icons_list = $('.js-icons-list');

            if ($icons_list.length > 0)
            {
                /*
                 * Count the number of icon list items
                 */

                var count = 0;
                var $icons_list_item_count = $('.js-icons-list-item-count');

                if ($icons_list_item_count.length > 0)
                {
                    count = Number($icons_list_item_count.val());
                }

                /*
                 * Add icon list item
                 */

                var $icons_list_item_add = $('.js-icons-list-item-add');

                if ($icons_list_item_add.length > 0)
                {
                    $icons_list_item_add.on('click', function ()
                    {
                        if (typeof iconListItemHTML !== 'undefined' && iconListItemHTML !== null && iconListItemHTML !== '')
                        {
                            count++;

                            /*
                             * Replace #COUNT# with the dynamic count value
                             */

                            var iconListItemHTMLUpdated = iconListItemHTML.replace(/#COUNT#/g, '' + count);
                            $icons_list.append(iconListItemHTMLUpdated);

                            /*
                             * Update the icon list item count
                             */

                            $icons_list_item_count.val(count);
                        }
                    });
                }

                /*
                 * Remove icon list item
                 */

                $icons_list.on('click', '.js-icons-list-item-remove', function (e) // Event handling for dynamically added content within the icons list
                {
                    e.preventDefault();

                    var id = $(this).data('icons-list-item-id');

                    if (id !== null)
                    {
                        var $remove = $('#' + id);

                        if ($remove.length > 0)
                        {
                            count--;
                            $remove.remove();

                            /*
                             * Update the icon list item count
                             */
                            $icons_list_item_count.val(count);
                        }
                    }
                });
            }

            /* ==========================================================================
               Navigation
               ========================================================================== */

            var $nav_toggle = $('.js-nav-toggle');

            if ($nav_toggle.length > 0)
            {
                var $nav = $('.js-nav');

                $nav_toggle.on('click', function (e)
                {
                    e.preventDefault();

                    $nav_toggle.toggleClass('is-active');
                    $nav.toggleClass('is-open');
                });
            }

            /* ==========================================================================
               Navigation Dropdown
               ========================================================================== */

            var $nav_dropdown = $('.js-nav-dropdown');

            if ($nav_dropdown.length > 0)
            {
                $('a', $nav_dropdown).each(function ()
                {
                    var $anchor = $(this);
                    var $anchor_icon = $('.icon', $anchor);
                    var $menu = $anchor.next('.list--menu');
                    var icon_up = $anchor.data('icon-up');
                    var icon_down = $anchor.data('icon-down');

                    $anchor.on('click', function (e)
                    {
                        /**
                         * Prevent click on primary drop-down anchor
                         */

                        if ($(this).next().hasClass('list--menu'))
                        {
                            e.preventDefault();
                        }

                        $menu.toggleClass('is-open');

                        if ($menu.hasClass('is-open'))
                        {
                            $menu.attr('aria-hidden', 'false');
                            $anchor_icon.removeClass(icon_down).addClass(icon_up);
                        }
                        else
                        {
                            $menu.attr('aria-hidden', 'true');
                            $anchor_icon.removeClass(icon_up).addClass(icon_down);
                        }

                        $('.list--menu', $nav_dropdown).not($menu).removeClass('is-open').attr('aria-hidden', 'true');
                        $('.icon', $nav_dropdown).not($anchor_icon).removeClass(icon_up).addClass(icon_down);
                    });
                });
            }

            /* ==========================================================================
               Placeholder
               ========================================================================== */

            $('input, textarea').placeholder();

            /* ==========================================================================
               Tabs
               ========================================================================== */

            var $tabs_component = $('.js-tabs');

            if ($tabs_component.length > 0)
            {
                $tabs_component.each(function ()
                {
                    var $tabs = $(this);
                    var $tablist = $('.tab-list', $tabs);
                    var $tablist_link = $('a', $tablist);

                    $tablist_link.on('click', function (e)
                    {
                        e.preventDefault();

                        var $link = $(this);
                        var $tab = $link.parent();
                        var tab_panel_id = $tab.attr('aria-controls');
                        var $tab_panel = $('#' + tab_panel_id);

                        /*
                         * Reset the display of all other tabs
                         */

                        $('.tab-list li', $tabs).not($tab).removeClass('is-selected').attr('aria-selected', 'false');
                        $('.tab-panel', $tabs).not($tab_panel).removeClass('is-active').attr('aria-hidden', 'true');

                        /*
                         * Display the selected tab
                         */

                        if (!$tab.hasClass('is-selected'))
                        {
                            $tab.attr('aria-selected', 'true');
                            $tab.addClass('is-selected');
                            $tab_panel.addClass('is-active');
                            $tab_panel.attr('aria-hidden', 'false');
                        }
                    });
                });
            }

            /* ==========================================================================
               Toggle Dropdown Buttons
               ========================================================================== */

            var $toggle_dropdown_buttons = $('.js-toggle-dropdown-btn');

            if ($toggle_dropdown_buttons.length > 0)
            {
                $toggle_dropdown_buttons.each(function ()
                {
                    var $button = $('.btn', $(this));

                    $button.on('click', function ()
                    {
                        /**
                         * Open the current dropdown
                         */

                        $(this).toggleClass('is-active');

                        var dropdown_id = $(this).data('dropdown-id');
                        var $dropdown = $('#' + dropdown_id);

                        if ($dropdown.length > 0)
                        {
                            $dropdown.toggleClass('is-open');

                            /**
                             * Toggle ARIA attributes
                             */

                            if ($dropdown.hasClass('is-open'))
                            {
                                $dropdown.attr('aria-hidden', 'false');
                                $button.attr('aria-expanded', 'true');
                            }
                            else
                            {
                                $dropdown.attr('aria-hidden', 'true');
                                $button.attr('aria-expanded', 'false');
                            }

                            /**
                             * Close all other dropdowns
                             */

                            var $dropdowns = $('.dropdown', $toggle_dropdown_buttons);

                            $dropdowns.not($dropdown).each(function ()
                            {
                                $(this).removeClass('is-open');
                                $(this).attr('aria-hidden', 'true');
                            });
                        }
                    });
                });
            }

            /* ==========================================================================
               Toggle Item
               ========================================================================== */

            var $toggle_item = $('.js-toggle-item');

            if ($toggle_item.length > 0)
            {
                $toggle_item.each(function ()
                {
                    var $toggle = $(this);
                    var input_focus = $toggle.data('input-focus');

                    $toggle.on('click', function ()
                    {
                        var id = $toggle.data('toggle-id');
                        var $item = $('#' + id);

                        /**
                         * Toggle the display of the container
                         */

                        if ($item.length > 0)
                        {
                            $item.toggleClass('u-hidden');

                            if (input_focus) // Set focus to the first input in the container
                            {
                                $('input:first', $item).focus();
                            }
                        }
                    });
                });
            }

            /* ==========================================================================
               Toggle Password
               ========================================================================== */

            var $toggle_password = $('.js-toggle-password');

            if ($toggle_password.length > 0 && isModernBrowser)
            {
                $toggle_password.each(function ()
                {
                    var $form = $(this);
                    var $input = $('input[type="password"]', $form);
                    var $toggle = $('.js-toggle', $form);

                    $toggle.removeClass('u-visuallyhidden'); // Enable the toggle button

                    /*
                     * Switch the input type
                     */

                    $toggle.on('click', function (e)
                    {
                        e.preventDefault();

                        if ($input.attr('type') == 'password')
                        {
                            $toggle.html('Hide');
                            $input.attr('type', 'text');
                        }
                        else
                        {
                            $toggle.html('Show');
                            $input.attr('type', 'password');
                        }

                        $input.focus(); // Keep keyboard active on touchscreen devices
                    });

                    /*
                     * Reset the input type
                     */

                    $form.on('submit', function ()
                    {
                        $input.attr('type', 'password');
                    });
                });
            }

            /* ==========================================================================
               Tooltips
               ========================================================================== */

            var $tooltips = $('.js-tooltip');

            if ($tooltips.length > 0)
            {
                $tooltips.each(function ()
                {
                    $(this).tooltip();
                });
            }

            /* ==========================================================================
               Block Manager
               ========================================================================== */

            $('.js-move-block-up').on('click', function () {
                var $currentBlock = $(this).closest('.card');
                var $previousBlock = $currentBlock.prev('.card');

                if ($previousBlock.length > 0) {
                    $currentBlock.insertBefore($previousBlock);
                    $(this).closest('form').addClass('dirty');
                }
            });

            $('.js-move-block-down').on('click', function () {
                var $currentBlock = $(this).closest('.card');
                var $nextBlock = $currentBlock.next('.card');

                if ($nextBlock.length > 0) {
                    $nextBlock.insertBefore($currentBlock);
                    $(this).closest('form').addClass('dirty');
                }
            });

            /* ==========================================================================
               Icon List Block: Icon Remover
               ========================================================================== */

            $('.js-icon-option-remove').on('click', function () {
                $(this).parent().remove();
            });

            /* ==========================================================================
               Key Features Add Button
               ========================================================================== */

            var addKeyFeature = function() {
                var $newBlock = $(
                        '<label class="label js-key-feature-entry" for="feature-new">'+
                            '<span class="u-visuallyhidden">New Key Feature</span>'+
                            '<input class="input" type="text" id="feature-new" name="key_features[]" maxlength="140" placeholder="e.g. Unlimited Beneficiaries" value="" />'+
                        '</label>');
                $newBlock.insertBefore($(this));
            };

            $('.js-key-feature-add').on('click', addKeyFeature);

            /* ==========================================================================
               Callout options Toggle
               ========================================================================== */

            $('.js-callout-toggle').on('click', function() {
                var option = $(this).val();
                $optionSelector = $('.js-callout-option[data-option='+option+']');

                if ($(this).is(':checked')) {
                    $optionSelector.removeClass('u-hidden').find('input.js-callout-nullinput').remove();
                } else {
                    var $nullinput = $('<input type="hidden" name="makeNull[]" value="'+option+'" class="js-callout-nullinput">');
                    $optionSelector.addClass('u-hidden').append($nullinput);
                }
            });

            /* ==========================================================================
               Media drag drop and toggle support
               ========================================================================== */

            $('.js-media-dropzone').on('drop', function(e) {
                e.preventDefault();
                $('.js-media-input').trigger('drop', e);
            });

            $('.js-media-dropzone').on('click', function(e) {
                $('.js-media-input').trigger('click', e);
            });

            $('.js-media-dropzone').on('dragover', function(e) {
                e.preventDefault();
                $('.js-media-input').trigger('dragover', e);
            });

            $('.js-media-dropzone').on('dragenter', function(e) {
                e.preventDefault();
                $('.js-media-input').trigger('dragenter', e);
            });

            $('.js-media-deselect').on('click', function() {
                $('.js-media-select-button').removeClass('u-hidden');
                var $preview = $('.js-media-select-preview').addClass('u-hidden');
                var $input = $('.js-media-selected-input');
                if ($input.length > 0) {
                    $input.val('');
                } else {
                    $preview.find('input[name=media_id]').val('');
                }
            });

            $('.js-media-select').on('click', function() {
                $('.js-media-select-button').addClass('u-hidden');
                var mediaID = $(this).attr('data-media-id');
                var mediaURL = $(this).attr('data-media-url');
                var $preview = $('.js-media-select-preview')
                        .removeClass('u-hidden');
                var $input = $('.js-media-selected-input');
                if ($input.length > 0) {
                    $input.val(mediaID);
                } else {
                    $preview.find('input[name=media_id]').val(mediaID);
                }
                $preview.find('img').attr('src', '').attr('src', mediaURL);
            });
            
            /* ==========================================================================
               Delete warning trigger
               ========================================================================== */
            
            var publishedWarning = false;
            
            $('#delete-user').click(function(e){
                e.preventDefault();

                if($('.alert--success').length > 0) {
                    $('.alert--success').fadeOut();
                }

                if($('.alert--warning').length === 0) {
                    $delete_warning = '<div class="alert alert--warning js-alert" role="alert"><div class="alert__title">Warning</div><p class="alert__message">Are you sure you want to delete this user? <a href="#" id="delete-user-link" class="alert__link">Delete User</a> or <a href="#" id="cancel-delete" class="alert__link">continue without deleting</a></p><button class="alert__dismiss js-dismiss"><span class="icon fa fa-times" aria-hidden="true"></span></button></div>';
                    $('.header--page').after($delete_warning);

                    $('#cancel-delete').click(function(){
                        $('.alert--warning').fadeOut();
                        $('.alert--warning').remove();
                    });

                    $('.js-dismiss').click(function(){
                        $('.alert--warning').fadeOut();
                        $('.alert--warning').remove();
                    });

                    $('#delete-user-link').click(function(e){
                        e.preventDefault();
                        $('#delete-user-form').submit();
                    });                    
                }

            });

            /* ==========================================================================
               Published warning trigger
               ========================================================================== */

            $('.js-form-published-warn').submit(function(){
                $('#published-warning').modal();
                return publishedWarning;
            });
            
            $('#published-warning .js-warning-update').click(function(){
                publishedWarning = true;
                $('.js-form-published-warn').submit();
            });

            /* ==========================================================================
               Icon list entry adder and icon preview
               ========================================================================== */

            var $iconListEntryBtn = $('.js-icon-list-entry-add');
            var prevClass = 'js-icon-list-select-preview';    
            if ($iconListEntryBtn.length > 0) {
                $iconListEntryBtn.click(function() {
                    var $iconListEntry = $('.js-icon-list-entry');
                    $clone = $iconListEntry.last().clone();
                    // Increment ID
                    var oldID = parseInt($clone.attr('id'));
                    var newID = oldID+1;
                    $clone.find("#accordion-tab-"+oldID)
                            .attr('id', "accordion-tab-"+newID)
                            .attr('aria-controls', "accordion-panel-"+newID)
                    $clone.find("#accordion-panel-"+oldID)
                            .attr('id', "accordion-panel-"+newID)
                            .attr('aria-labelledby', "accordion-tab-"+newID);
                    $clone.find(".js-icons-list-item-remove")
                            .attr('data-icons-list-item-id', newID);
                    $clone.find('input[type=radio]').attr('name', "icon_list["+newID+"][class]")
                    $clone.find('input[type=text]').attr('name', "icon_list["+newID+"][text]")
                    var i = 0;
                    do {
                        $label = $clone.find(".js-icon-list-select-radio[for='radio-"+i +"-"+oldID +"']");
                        if ($label.length <= 0) {
                            break;
                        }
                        $label.find("input#radio-"+i +"-"+oldID).attr('id', "radio-"+i +"-"+newID);
                        $label.attr('for', "radio-"+i +"-"+newID);
                        i++;
                    } while (true);
                    $clone.attr('id', newID);
                    // Reset values
                    $clone.find('input[type="text"]').val('');
                    $clone.find('.js-icons-list-item-remove').show();
                    // Add to DOM
                    $iconListEntry.last().parent().append($clone);
                });
            }
            var jsRadioSelector = '.js-icon-list-select-radio input';
            if ($(jsRadioSelector).length > 0) {
                $(document).on('click', jsRadioSelector, function(e) {
                    var iconClass = $(this).parent().find('span').attr('class');
                    var $button = $(this)
                        .parent()
                        .parent()
                        .parent();
                    $button.find("."+prevClass).fadeOut('fast', function() {
                        $(this).attr('class', iconClass+" "+prevClass);
                        $(this).fadeIn('fast').parent('.js-icon-list-select-placeholder');
                    });
                    $button.find('.js-icon-list-select-placeholder:visible').fadeOut('fast');
                });
                $(document).on('click', jsRadioSelector, accordionHideFunc);
            }

            /* ==========================================================================
               Cloneable Entry (Text Input mainly like urls)
               ========================================================================== */
            
            var $cloneableEntries = $('.js-clone-entry-add');
            
            $cloneableEntries.each(function() {
                var cloneSelector = "."+ $(this).data('clone');
                if (cloneSelector !== undefined && $(cloneSelector).length > 0) {
                    $(cloneSelector).hide();
                } else {
                    cloneSelector = null;
                }
                // Handle click event
                $(this).click(function() {
                    if (cloneSelector === null) {
                        return ;
                    }
                    var $existing = $(cloneSelector).last();
                    var $cloned = $existing.clone();
                    var clonekey = $existing.data('clonekey');
                    if (clonekey !== undefined) {
                        clonekey = parseInt(clonekey);
                        clonekey++;
                        $cloned.attr('data-clonekey', clonekey);
                        $existing.removeAttr('data-clonekey');
                        $existing.find('label').each(function() {
                            var idFor = $(this).attr('for').replace('id', clonekey);
                            $(this).attr('for', idFor);
                            $(this).find('input,select').each(function() {
                                var id = $(this).attr('id').replace('id', clonekey);
                                var name = $(this).attr('name').replace('id', clonekey);
                                $(this).attr('id', id);
                                $(this).attr('name', name);
                            });
                        });
                    }
                    $existing.find('input').removeAttr('disabled');
                    $existing.removeClass(cloneSelector.replace('.', ''));
                    $existing.show();
                    $existing.after($cloned);
                    $existing.find('input').first().focus();
                });
            });
            
            /* ==========================================================================
               'Are you sure' support
               ========================================================================== */
            
            var $confirmForms = $('.js-confirm-form');
            
            $confirmForms.each(function() {
                $(this).areYouSure( { 'message' : 'You have unsaved changes, are you sure?' } );
                if ($(this).find('.has-error').length > 0) {
                    $(this).addClass('dirty');
                }
            });
            
            /* ==========================================================================
               Additional feature options
               ========================================================================== */
            
            var $featureCheckboxes = $('.js-feature-checkbox');
            
            $featureCheckboxes.each(function() {
                var feature = $(this).data('feature');
                if (feature !== undefined) {
                    var options = ".options_"+ feature;
                    if (!$(this).is(':checked')) {
                        $(options).hide();
                    }
                    // Apply option data if found
                    var $data = $(options).find("[data-applies-to="+feature+"]");
                    var $checkbox = $(this);
                    $data.each(function() {
                        if ($(this).is(':checked')) {
                            $checkbox.val($(this).val());
                        }
                        $(this).click(function() {
                            if ($(this).is(':checked')) {
                                $checkbox.val($(this).val());
                            }
                        });
                    });
                    $(this).click(function() {
                        if ($(this).is(':checked')) {
                            $(options).show();
                        } else {
                            $(options).hide();
                        }
                    });
                }
            });

            /* ==========================================================================
             Appends path fields
             ========================================================================== */

            var $pathsList = $('.js-paths-list');

            $pathsList.each(function() {
                var $pathList = $(this);
                $('.js-adds-path').click(function () {
                    var id = new Date().getTime();
                    var $newLabel = $('<label class="label" for="path-' + id + '"><input class="input" type="text" id="path-' + id + '" name="paths[]" maxlength="140"/></label>');
                    $pathList.append($newLabel);
                    $newLabel.focus();
                });
            });

            /* ==========================================================================
             Table editor
             ========================================================================== */

            var $tableEditor = $('.js-table-editor');

            $tableEditor.each(function() {
                var $table = $('.table');
                var $rows = $('input[name=table-editor-rows]');
                var $cols = $('input[name=table-editor-cols]');
                
                
                var buildOutput = function () {
                    var output = [];
                    var i = 0;
                    $.each($table.find('tr'), function () {
                        var rowOutput = [];
                        var j = 0;
                        var $ths = $(this);
                        $.each($ths.find('th, td'), function () {
                            rowOutput[j] = $(this).text();
                            j++;
                        }).promise().done(function() {
                            // Add data
                            output[i] = rowOutput;
                        });
                        i++;
                    }).promise().done(function() {
                        console.log(output);
                        $('.js-table-editor-output').val(JSON.stringify(output));
                    });
                };
                
                var update = function () {
                    var rows = parseInt($rows.val());
                    var cols = parseInt($cols.val());
                    
                    if (rows < 1) {
                        rows = 1;
                    }
                    
                    if (cols < 1) {
                        cols = 1;
                    }
                    
                    if (rows > 100) {
                        rows = 100;
                    }
                    
                    if (cols > 30) {
                        cols = 30;
                    }
                    
                    var i = 0;
                    $.each($table.find('tr'), function () {
                        if (i >= rows) {
                            $(this).remove();
                        } else {
                            var j = 0;
                            var $ths = $(this);
                            $.each($ths.find('th, td'), function () {
                                if (j >= cols) {
                                    $(this).unbind('keypress').remove();
                                } else {
                                    $(this).attr('contenteditable', 'true');
                                }
                                j++;
                            }).promise().done(function() {
                                while (j < cols) {
                                    if (i === 0) {
                                        $ths.append($('<th contenteditable="true"></th>'));
                                    } else {
                                        $ths.append($('<td contenteditable="true"></td>'));
                                    }
                                    j++;
                                }
                            });
                        }
                        i++;
                    }).promise().done(function() {
                        while (i < rows) {
                            $('.table tbody').append($('<tr>'+('<td contenteditable="true"> </td>'.repeat(cols))+'</tr>'));
                            i++;
                        }
                        $('.table thead tr th').unbind('keypress').on('keypress', buildOutput);
                        $('.table tbody tr td').unbind('keypress').on('keypress', buildOutput);
                        $('input[name=table-editor-rows]').val(rows+'');
                        $('input[name=table-editor-cols]').val(cols+'');
                        buildOutput();
                    });
                };
                
                update();
                
                $('.js-table-resize').click(update);
            });
        }
    },

    controller: {

        init: function ()
        {

        },

        view: function ()
        {

        }
    }
};

UTIL = {

    exec: function (controller, action)
    {
        var ns = SITENAME;
        action = ( action === undefined ) ? 'init' : action;

        if (controller !== '' && ns[controller] && typeof ns[controller][action] == 'function')
        {
            ns[controller][action]();
        }
    },

    init: function ()
    {
        var body = document.body;
        var controller = body.getAttribute('data-controller');
        var action = body.getAttribute('data-action');

        UTIL.exec('common');
        UTIL.exec(controller);
        UTIL.exec(controller, action);
    }
};
