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
            <div class="col-md-3">
                <label for="statuses">Statuses</label>
                <bootstrap-multiselect 
                    @valueChanged="statusesChanged" 
                    :options="statuses" 
                    :values="selected_statuses">
                    
                </bootstrap-multiselect>
            </div>
            <div class="col-md-1">
                <label for="statuses">&nbsp;</label>
                <button class="btn btn-primary" @click.prevent="search()">Filter</button>
            </div>
        </div>
    `,

    props: ['conditions', 'statuses', 'selectedConditionIds', 'selectedStatusIds'],

    data() {
        return {
            selected_conditions: this.selectedConditionIds == null ? [] : this.selectedConditionIds,
            selected_statuses: this.selectedStatusIds == null ? [] : this.selectedStatusIds
        }
    },

    methods:{
        conditionsChanged(conditions){
            console.log(conditions);
            this.selected_conditions = conditions;
        },
        statusesChanged(statuses){
            console.log(statuses);
            this.selected_statuses = statuses;
        },
        /**
         * Fire the search
         */
        search() {
            let conditionsString = '';
            let statusesString = '';
            if(this.selected_conditions.length > 0){
                conditionsString += 'conditions='+this.selected_conditions.join();
            }
            if(this.selected_statuses.length > 0){
                statusesString = 'statuses='+this.selected_statuses.join();
            }

            location.assign('/admin/recordings?'+conditionsString+'&'+statusesString);
        },
    }
});
