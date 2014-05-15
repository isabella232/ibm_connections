({
    extendsFrom: 'TeamsetField',

    roleTag: 'select.role',

    roles: {authors: "Member", owners: "Owner"},

    initialize: function (options) {
        this.events['change ' + this.roleTag] = 'changeRole';
        this._super('initialize',[options] );
    },

    _render: function () {
        this._super('_render');
        if (this.tplName === 'edit') {
            // Role drop down initialization
            this.$(this.roleTag).select2({
                minimumResultsForSearch: 7,
            });

            // Setting width 80% and hidding search more  
            this.$(this.fieldTag).each(function (index, el) {
                var plugin = $(el).data("select2");
                if (!_.isUndefined(plugin)) {
                    plugin.searchmore = true;
                    plugin.container.css('width', '80%');
                }

            });
        }
    },

    format: function (value) {
        value = value || [];
        value = app.utils.deepCopy(value);
        /*if (!_.isArray(value)) {
            value = [
                {
                    name: value
                }
            ];
        }*/

        // Place the add button as needed
        if (_.isArray(value)/* && value.length > 0 */) {
            _.each(value, function (member) {
                delete member.remove_button;
                delete member.add_button;
            });
            if (!value[this._currentIndex]) {
                value[this._currentIndex] = {role: _.first(_.keys(this.roles))   };
            }
            value[value.length - 1].add_button = true;

            // Show remove button if there are more than one
            _.each(value, function (member, key) {
                if (key > 0 || value.length > 1) {
                    member.remove_button = true;
                }
            });

        }
        return value;
    },

    changeRole: function (evt) {
        var $el = $(evt.currentTarget), index = $el.data('index');
        this.value[index]['role'] = $el.val();
        this._updateAndTriggerChange(this.value);
    }

})
