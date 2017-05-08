Vue.component('d3-bars-basic-tooltip-chart', {

    template: `
        <div class="chart"></div>
    `,

    props: ['heightVal', 'dataUrl'],

    mounted(){
        // Define main variables
        this.d3Container = d3.select(this.$el),
            this.margin = {top: 5, right: 10, bottom: 20, left: 40},
            this.width = this.d3Container.node().getBoundingClientRect().width - this.margin.left - this.margin.right,
            this.height = this.heightVal - this.margin.top - this.margin.bottom - 5;

        console.log(this.margin);
        console.log(this.width);
        console.log(this.height);

        // Construct scales
        // ------------------------------

        // Horizontal
        this.x = d3.scale.ordinal()
            .rangeRoundBands([0, this.width], .1, .5);

        // Vertical
        this.y = d3.scale.linear()
            .range([this.height, 0]);

        // Color
        this.color = d3.scale.category20c();

        // Create axes
        // ------------------------------

        // Horizontal
        this.xAxis = d3.svg.axis()
            .scale(this.x)
            .orient("bottom");

        // Vertical
        this.yAxis = d3.svg.axis()
            .scale(this.y)
            .orient("left");

        // Create chart
        // ------------------------------

        // Add SVG element
        this.container = this.d3Container.append("svg");

        // Add SVG group
        this.svg = this.container
            .attr("width", this.width + this.margin.left + this.margin.right)
            .attr("height", this.height + this.margin.top + this.margin.bottom)
            .append("g")
            .attr("transform", "translate(" + this.margin.left + "," + this.margin.top + ")");

        // Create tooltip
        // ------------------------------

        // Create tooltip
        this.tip = d3.tip()
            .attr('class', 'd3-tip')
            .offset([-10, 0])
            .html(function(d) {
                return d.value;
            });

        // Initialize tooltip
        this.svg.call(this.tip);

        //fetch data
        this.fetchData();
    },

    data(){
        return {
            //dataset: this.formatData
        }
    },

    methods: {

        loadData(data){
            // Pull out values
            data.forEach(function(d) {
                d.value = +d.value;
            });


            // Set input domains
            // ------------------------------

            // Horizontal
            this.x.domain(data.map(function(d) { return d.label; }));

            // Vertical
            this.y.domain([0, d3.max(data, function(d) { return d.value; })]);

            //
            // Append chart elements
            //

            // Append axes
            // ------------------------------

            // Horizontal
            this.svg.append("g")
                .attr("class", "d3-axis d3-axis-horizontal d3-axis-strong")
                .attr("transform", "translate(0," + this.height + ")")
                .call(this.xAxis);

            // Vertical
            var verticalAxis = this.svg.append("g")
                .attr("class", "d3-axis d3-axis-vertical d3-axis-strong")
                .call(this.yAxis);

            // Add text label
            verticalAxis.append("text")
                .attr("transform", "rotate(-90)")
                .attr("y", 10)
                .attr("dy", ".71em")
                .style("text-anchor", "end")
                .style("fill", "#999")
                .style("font-size", 12)
                .text("Total");


            var self = this;
            // Append bars
            this.svg.selectAll(".d3-bar")
                .data(data)
                .enter()
                .append("rect")
                .attr("class", "d3-bar")
                .style("fill", function(d) { return self.color(d.label); })
                .attr("x", function(d) { return self.x(d.label); })
                .attr("width", self.x.rangeBand())
                .attr("y", function(d) { return self.y(d.value); })
                .attr("height", function(d) { return self.height - self.y(d.value); })
                .on('mouseover', self.tip.attr('class', 'tooltip-inner in').show)
                .on('mouseout', self.tip.hide);
        },

        fetchData(){
            this.$http.get(this.dataUrl)
                .then(response => {
                    console.log(response.data.data);
                    this.loadData(response.data.data)
                })
                .catch(errors => {

                });
        }
    }

});
