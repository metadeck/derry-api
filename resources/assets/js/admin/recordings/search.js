Vue.component('recording-search-bar', {

    template: `
        <div class="container-fluid">
            <div class="col-md-3">
                <label for="conditions">Conditions</label>
                <bootstrap-multiselect 
                    @valueChanged="conditionsChanged" 
                    :options="conditions" 
                    :values="selected_conditions">
                </bootstrap-multiselect>
            </div>
            <div class="col-md-1">
                <label for="statuses">&nbsp;</label>
                <button class="btn btn-primary" @click.prevent="search()">Filter</button>
            </div>
        </div>
    `,

    props: ['conditions', 'selectedConditionIds'],

    data() {
        return {
            selected_conditions: this.selectedConditionIds == null ? [] : this.selectedConditionIds,
        }
    },

    methods:{
        conditionsChanged(conditions){
            console.log(conditions);
            this.selected_conditions = conditions;
        },
        /**
         * Fire the search
         */
        search() {
            let conditionsString = '';
            if(this.selected_conditions.length > 0){
                conditionsString += 'conditions='+this.selected_conditions.join();
            }

            location.assign('/admin/recordings?'+conditionsString);
        },
    }
});
