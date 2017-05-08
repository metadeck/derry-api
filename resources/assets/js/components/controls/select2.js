Vue.component('select-2', {

    template: `
        <select multiple>
            <slot></slot>
        </select>
    `,

    props: ['options', 'values'],

    mounted(){
        let self = this;
        $(this.$el)
            // init select2
            .select2({ data: this.options })
            // emit event on change.
            .on('change', function () {
                console.log("CHANGE")
                self.$emit('input', this.values)
            })
    },

    // watch: {
    //     values: function (value) {
    //         // update value
    //         $(this.$el).select2('val', values)
    //     },
    //     options: function (options) {
    //         // update options
    //         $(this.$el).select2({ data: options })
    //     }
    // },
    //
    // destroyed: function () {
    //     $(this.$el).off().select2('destroy')
    // }
});
