Vue.component('media-upload', {

    template: `
        <div>
            <div class="alert alert-danger" v-if="form.errors.has('media')">
                {{ form.errors.get('media') }}
            </div>
            <div class="form-group" v-if="type == 'image'">
                <img :src="mediaUrl" alt="Profile Image" v-if="mediaUrl">
            </div>
            <div class="form-group">
                <input type="hidden" ref="media_id" name="media_id" v-if="mediaId" v-model="mediaId">
                <input type="file" ref="media_file" :disabled="form.busy" @change.prevent="update">
            </div>
        </div>
    `,

    props: ['media', 'type', 'relationship', 'directory'],

    data() {
        return {
            mediaUrl: (this.media) ? this.media.full_media_path : null,
            mediaId: (this.media) ? this.media.id : null,
            form: new Form({})
        };
    },

    methods: {
        update() {
            var self = this;

            this.form.startProcessing();

            $.ajax({
                url: ((this.mediaId) ? '/media/' + this.$refs.media_id.value : '/media'),
                data: this.gatherFormData(),
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                headers: {
                    'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN')
                },
                success: function (data) {
                    self.form.finishProcessing();
                    self.mediaUrl = data.data.full_media_path;
                    self.mediaId = data.data.id;
                    self.$emit('uploaded', data.data.id)
                },
                error: function (error) {
                    self.form.setErrors(error.responseJSON);
                }
            });
        },

        gatherFormData() {
            const data = new FormData();

            data.append('relationship', this.relationship);
            data.append('directory', this.directory);
            data.append('media', this.$refs.media_file.files[0]);

            if (this.$refs.media_id) {
                data.append('media_id', this.$refs.media_id.value);
            }

            return data;
        }
    }

})