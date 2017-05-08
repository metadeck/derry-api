Vue.component('bootstrap-multiselect', {

    template: `
        <select class="multiselect" multiple="multiple">
            <option v-for="(option, index) in options" :value="option.value">{{ option.text }}</option>
        </select>
        
    `,

    props: ['options', 'values', 'id'],

    data(){
      return {
          selectedValues: []
      }
    },

    mounted(){
        let self = this;
        $(this.$el)
            .multiselect({
                numberDisplayed: 2,
                onChange: function(option, checked) {
                    $.uniform.update();
                    self.valueChanged(option[0].value, checked)
                }
            });

        if(this.values != null){
            // Set the value
            $(this.$el).val(this.values);
            // Then refresh
            $(this.$el).multiselect("refresh");

        }

        // Styled checkboxes and radios
        $(".styled, .multiselect-container input").uniform({ radioClass: 'choice'});
    },

    methods:{
        valueChanged(value, checked){
            if(checked){
                if(this.selectedValues.indexOf(value) == -1) {
                    this.selectedValues.push(value)
                }
            } else {
                let index = this.selectedValues.indexOf(value);
                if(index > -1) {
                    this.selectedValues.splice(index, 1)
                }
            }
            this.$emit('valueChanged', this.selectedValues)
        }
    }
});
