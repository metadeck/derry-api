Vue.component('jquery-ui-sortable', {

    template: `
        <div class="draggable">
            <slot></slot>
        </div>
    `,

    data() {
        return {
            oldIndex: null,
            newIndex: null
        }
    },

    mounted() {
        let self = this;
        $(this.$el)
            .sortable({
                connectWith: '.row-sortable',
                items: '.panel',
                helper: 'original',
                cursor: 'move',
                handle: '[data-action=move]',
                revert: 100,
                containment: '.content-wrapper',
                forceHelperSize: true,
                placeholder: 'sortable-placeholder',
                forcePlaceholderSize: true,
                tolerance: 'pointer',
                start: function(e, ui){
                    self.oldIndex = ui.item.index();
                    ui.placeholder.height(ui.item.outerHeight());
                },
                stop: function(e, ui) {
                    self.newIndex = ui.item.index();
                    self.orderChanged();
                }
            });
    },

    methods:{
        orderChanged(){
            this.$emit('orderChanged', this.$data);
        }
    }
});
