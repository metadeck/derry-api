Vue.component('jquery-ui-datepicker', {

    template: `
        <input type="text" class="form-control" placeholder="Pick a date…"/>
    `,

    mounted(){
        let self = this;
        $(this.$el)
            //init datepicker
            .datepicker({
                onSelect: function(dateText) {
                    self.$emit('dateSelected', dateText)
                }
            });
    },

    destroyed: function () {
        $(this.$el).off().datepicker('destroy')
    }
});
