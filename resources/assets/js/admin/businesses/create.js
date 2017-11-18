Vue.component('business-create', {

    template: `
        <div>
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                The business has been created!
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
                
                <div class="form-group" :class="{'has-error': form.errors.has('address_1')}">
                    <label class="control-label col-lg-2">Address 1</label>
                    <div class="col-lg-10">
                        <input type="text" v-model="form.address_1" class="form-control" placeholder="Address 1">
                        <span class="help-block" v-show="form.errors.has('address_1')">
                            {{ form.errors.get('address_1') }}
                        </span>
                    </div>
                </div>
                
                <div class="form-group" :class="{'has-error': form.errors.has('address_2')}">
                    <label class="control-label col-lg-2">Address 2</label>
                    <div class="col-lg-10">
                        <input type="text" v-model="form.address_2" class="form-control" placeholder="Address 2">
                        <span class="help-block" v-show="form.errors.has('address_2')">
                            {{ form.errors.get('address_2') }}
                        </span>
                    </div>
                </div>
                
                <div class="form-group" :class="{'has-error': form.errors.has('town_city')}">
                    <label class="control-label col-lg-2">Town/City</label>
                    <div class="col-lg-10">
                        <input type="text" v-model="form.town_city" class="form-control" placeholder="Town/City">
                        <span class="help-block" v-show="form.errors.has('town_city')">
                            {{ form.errors.get('town_city') }}
                        </span>
                    </div>
                </div>
                
                <div class="form-group" :class="{'has-error': form.errors.has('county')}">
                    <label class="control-label col-lg-2">County</label>
                    <div class="col-lg-10">
                        <input type="text" v-model="form.county" class="form-control" placeholder="County">
                        <span class="help-block" v-show="form.errors.has('county')">
                            {{ form.errors.get('county') }}
                        </span>
                    </div>
                </div>
                
                <div class="form-group" :class="{'has-error': form.errors.has('postal_code')}">
                    <label class="control-label col-lg-2">Postal Code</label>
                    <div class="col-lg-10">
                        <input type="text" v-model="form.postal_code" class="form-control" placeholder="Postal Code">
                        <span class="help-block" v-show="form.errors.has('postal_code')">
                            {{ form.errors.get('postal_code') }}
                        </span>
                    </div>
                </div>
                
                <div class="form-group" :class="{'has-error': form.errors.has('location')}">
                    <label class="control-label col-lg-2">Location</label>
                    <div class="col-lg-10">
                        <map-location-selector
                            @locationUpdated="locationUpdated">
                        </map-location-selector>
                        <span class="help-block" v-show="form.errors.has('location')">
                            {{ form.errors.get('location') }}
                        </span>
                    </div>
                </div>
                
                <div class="form-group" :class="{'has-error': form.errors.has('categories')}">
                    <label class="control-label col-lg-2">Categories</label>
                    <div class="col-lg-10">
                        <div class="checkbox" v-for="category in categories">
                            <label>
                                <input type="checkbox" class="control-success" :value="category.id" v-model="form.categories">
                                {{ category.text }}
                            </label>
                        </div>
                        <span class="help-block" v-show="form.errors.has('categories')">
                            {{ form.errors.get('categories') }}
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
                                Create business
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `,

    props:['categories'],

    data() {
        return {
            form: new Form({
                name: null,
                address_1: null,
                address_2: null,
                town_city: null,
                postal_code: null,
                county: null,
                latitude: null,
                longitude: null,
                categories: []
            })
        }
    },

    methods:{
        /**
         * Save the business.
         */
        save() {
            Limitless.post('/admin/business', this.form)
                .then((response) => {
                    location.assign('/admin/businesses/');
                });
        },

        locationUpdated(latlng) {
            console.log("CAUGHT LOCATION UPDATED EVENT");
            this.form.latitude = latlng.lat;
            this.form.longitude = latlng.lng;
        }
    }
});
