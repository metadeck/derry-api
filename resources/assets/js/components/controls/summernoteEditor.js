Vue.component('summernote-editor', {

    template : `
       <textarea></textarea>
    `,

    props: ['content'],

    mounted(){
        var _this = this;

        //simple toolbar
        $(this.$el).summernote({
            toolbar: [
                [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'clear'] ],
                [ 'style', [ 'style' ] ],
                [ 'fontname', [ 'fontname' ] ],
                [ 'fontsize', [ 'fontsize' ] ],
                [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', [ 'link'] ],
                [ 'view', [ 'fullscreen', 'codeview' ] ]
            ],
            callbacks: {
                onPaste: function (e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    e.preventDefault();
                    document.execCommand('insertText', false, bufferText);
                },
                onChange: function(html) {
                    _this.contentUpdated(html);
                }
            }
        });

        // Set default value of editor.
        $(this.$el).summernote('code', this.content);

        // Style form components
        $('.styled').uniform();
    },

    methods: {
        contentUpdated: function(html) {
            this.$emit('contentUpdated', html);
        }
    }
});