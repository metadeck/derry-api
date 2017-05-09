Vue.component('recording-create', {

    template: `
        <div>
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                The recording has been created!
            </div>
    
            <div class="form-horizontal">
                <div class="form-group" :class="{'has-error': form.errors.has('building_id')}">
                    <label class="control-label col-lg-2">Building</label>
                 
                    <div class="col-lg-10">
                        <select-menu 
                        @valueChanged="buildingChanged" 
                        :options="buildings">
                        </select-menu>
                        <span class="help-block" v-show="form.errors.has('building_id')">
                            {{ form.errors.get('building_id') }}
                        </span>
                    </div>
                </div>
                
                <div class="form-group" :class="{'has-error': form.errors.has('condition_id')}">
                    <label class="control-label col-lg-2">Condition</label>
                 
                    <div class="col-lg-10">
                        <select-menu 
                        @valueChanged="conditionChanged" 
                        :options="conditions">
                        </select-menu>
                        <span class="help-block" v-show="form.errors.has('condition_id')">
                            {{ form.errors.get('condition_id') }}
                        </span>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-6">
                        <button type="submit" class="btn btn-primary" @click.prevent="save" :disabled="form.busy">
                            <span v-if="form.busy">
                                <i class="fa fa-btn fa-spinner fa-spin"></i>Saving
                            </span>
                            <span v-else>
                                Create Recording
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `,

    props:['conditions', 'buildings'],

    data() {
        return {
            form: new Form({
                building_id: null,
                condition_id: null,
                at_risk: null,
                comment: null
            })
        }
    },

    methods:{
        buildingChanged(buildingId){
          console.log(buildingId);
        },
        conditionChanged(conditionId){
            console.log(conditionId);
        },
        /**
         * Save the recording.
         */
        save() {
            Limitless.post('/admin/recording', this.form)
                .then((response) => {
                    location.assign('/admin/recordings/');
                });
        }
    }
});
