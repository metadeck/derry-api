Vue.component('status-create', {

    template: `
        <div>
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                The status has been created!
            </div>
    
            <div class="form-horizontal">
                <div class="form-group" :class="{'has-error': form.errors.has('name')}">
                    <label class="control-label col-lg-2">Name</label>
                    <div class="col-lg-10">
                        <input type="text" v-model="form.name" class="form-control" placeholder="Name">
                        <span class="help-block" v-show="form.errors.has('name')">
                            {{ form.errors.get('name') }}
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
                                Update Status
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `,

    data() {
        return {
            form: new Form({
                name: null,
            })
        }
    },

    methods:{
        /**
         * Save the building.
         */
        save() {
            Limitless.post('/admin/status', this.form)
                .then((response) => {
                    location.assign('/admin/statuses/');
                });
        },
    }
});
