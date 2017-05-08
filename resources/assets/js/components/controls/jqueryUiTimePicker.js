Vue.component('jquery-ui-timepicker', {

    template: `
        <input class="form-control" :value="defaultTime" readonly/>
    `,

    props: ['defaultTime'],

    mounted(){
        let self = this;

        $.widget("ui.timespinner", $.ui.spinner, {
            options: {
                step: 60 * 1000 * 5 // 5 minutes
            },
            _parse: function(value) {
                if (typeof value === "string") {

                    // Already a timestamp
                    if (Number(value) == value) {
                        return Number(value);
                    }
                    return +Globalize.parseDate(value);
                }
                return value;
            },
            _format: function(value) {
                return Globalize.format(new Date(value), "t");
            }
        });

        // Initialize
        $(this.$el).timespinner({
            spin: function( event, ui) {
                console.log(ui.value);
                self.timeChanged(Globalize.format(new Date(ui.value), "HH:mm"))
            },
        });

        //fire a change event with default value to be picked up on load
        this.timeChanged(Globalize.format(new Date(this.defaultTime), "HH:mm"))
    },

    methods:{
        timeChanged(timeString){
            this.$emit('timeSelected', timeString)
        }
    },

    destroyed: function () {
        $(this.$el).off().timespinner('destroy')
    }
});
