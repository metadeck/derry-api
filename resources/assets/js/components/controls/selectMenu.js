Vue.component('select-menu', {

    template: `
        <select class="select-basic" v-model="value">
            <option v-if="placeholder != null" value="0" disabled>{{ placeholder }}</option>
            <option v-for="(option, index) in options" :value="option.value">{{ option.text }}</option>
        </select>
    `,

    props: ['options', 'value', 'placeholder'],

    mounted(){
        let self = this;
        $(this.$el)
            .selectmenu({
                width: '100%',
                change: function( event, ui ) {
                    self.valueChanged(ui.item.value);
                }
            });

        //fire a change event with default value to be picked up on load
        //if(this.value)
          //  this.valueChanged(this.value);
    },

    methods:{
        valueChanged(newValue){
            this.$emit('valueChanged', newValue);
        }
    },

    destroyed: function () {
        $(this.$el).off().selectmenu('destroy')
    }
});
