Vue.component('paginated-table', {

    template: `
        <div>
            <table class="table table-bordered table-striped">
                <thead>
                    <th v-for="tableHeader in tableHeaders">{{ tableHeader }}</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr v-for="tableRow in tableRows">
                        <td v-for="value in tableRow.values">{{ value }}</td>
                        <td>
                            <ul class="icons-list">
                                <li class="text-primary-600"><a :href="tableRow.editUrl">Edit</a></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="pagination-container" v-show="pagination != null">
                <b>Showing {{ paginationFrom }} to {{ paginationTo }} of {{ paginationTotal }}</b>
                
                <ul class="pagination pull-right">
                    <li v-for="item in paginationItems" :class="{ current: item.isCurrent }">
                        <a @click="fetchData(item.page)">{{ item.page }}</a>
                    </li>
                </ul>
            </div>
        </div>
    `,

    props: {
        // dataurl is a required string
        dataUrl: {
            type: String,
            required: true
        },
        editUrl: {
            type: String,
            required: true
        },
        // per page with default value
        perPage: {
            type: Number,
            default: 20
        },
        // comma separated fields to display in the table
        fields: {
            type: String,
            required: true
        }
    },

    mounted(){
        this.fetchData(this.currentPage)
    },

    data() {
        return {
            tableHeaders: this.fields.split(','),
            tableRows:[],
            pagination:null,
            paginationItems:[],
            paginationFrom:null,
            paginationTo:null,
            paginationTotal:null,
            currentPage:1,
            totalPages:0,
            fetchingData:false,
            initialLoad:true
        }
    },

    methods:{
        fetchData(page) {

            // if data is already being loaded
            // then return straight away
            if (this.fetchingData) {
                return
            }

            this.fetchingData = true

            let url = this.dataUrl + '?page='+page+'&perPage='+this.perPage

            this.$http.get(url)
                .then(response => {

                    this.initialLoad = false

                    this.fetchingData = false

                    this.currentPage = page

                    this.pagination = response.data.data

                    this.buildTableData()

                    this.buildPaginationLinks()

                })
        },

        buildTableData() {
            //reset the data
            this.tableRows = [];
            _.each(this.pagination.data, dataObject => {
                //pick out the fields we need to display
                let tableRowData = _.pick(dataObject, this.fields.split(','))
                tableRowData.values = _.values(tableRowData)
                tableRowData.editUrl = this.editUrl.replace(new RegExp('{rowid}', 'gi'), dataObject.id)
                this.tableRows.push(tableRowData)
            })
        },

        buildPaginationLinks() {
            //reset the data
            this.paginationItems = [];

            this.paginationFrom = this.pagination.from
            this.paginationTo = this.pagination.to
            this.paginationTotal = this.pagination.total

            for(var i=1; i<= this.pagination.last_page; i++){
                let current = false
                if(i == this.pagination.current_page){
                    current = true
                }
                let paginationItem = {isCurrent: current, page: i}
                this.paginationItems.push(paginationItem)
            }
        }
    }
})