Vue.component('jquery-ui-slider-pips', {

    template: `
        <div class="ui-slider-pips"></div>
    `,

    props: ['max', 'min', 'value'],

    mounted(){
        let self = this;
        //init slider
        $(this.$el)
            .slider({
                max: this.max,
                min: this.min,
                value: this.value,
                change: function( event, ui ) {
                    self.valueChanged(ui.value);
                }
            });

        //add pips or float
        $(this.$el).slider("pips", {
            rest: 'label'
        });
    },

    methods:{
        valueChanged(newValue){
            this.$emit('valueChanged', newValue);
        }
    }
});