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
                        <input type="text" v-model="form.building_id" class="form-control" placeholder="Building ID">
                        <span class="help-block" v-show="form.errors.has('building_id')">
                            {{ form.errors.get('building_id') }}
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

    props:['statuses', 'conditions'],

    data() {
        return {
            form: new Form({
                building_id: null,
                status_id: null,
                condition_id: null,
                comment: null
            })
        }
    },

    methods:{
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
