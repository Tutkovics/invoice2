
    <svg id="visualisation" width="500" height="200"></svg>

    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>

    <style>
        .axis path {
            fill: none;
            stroke: #777;
            shape-rendering: crispEdges;
        }
        .axis text {
            font-family: Lato;
            font-size: 13px;
        }
    </style>

    <script>
        function getMax(arr, prop) {
            var max;
            for (var i=0 ; i<arr.length ; i++) {
                if (!max || parseInt(arr[i][prop]) > parseInt(max[prop]))
                    max = arr[i];
            }
            return max;
        }

        function getMin(arr, prop) {
            var min;
            for (var i=0 ; i<arr.length ; i++) {
                if (!min || parseInt(arr[i][prop]) < parseInt(min[prop]))
                    min = arr[i];
            }
            return min;
        }

        var data =[
            @php( $sum = 0 )
            @foreach($bill->transactions as $trans)
            {
                "date": {{ (new Carbon\Carbon($trans->created_at))->timestamp * 1000 }},
                "amount": @php if($trans->income) $sum+=$trans->amount; else $sum-=$trans->amount;@endphp {{ $sum }}
            },
            @endforeach
        ];

        var help = {
            xDomMin: getMin(data, "date").date,
            xDomMax: getMax(data, "date").date,
            yDomMin: getMin(data, "amount").amount-300,
            yDomMax: getMax(data, "amount").amount+300,
        };

        var vis = d3.select("#visualisation"),
            WIDTH = 500,
            HEIGHT = 200,
            MARGINS = {
                top: 20,
                right: 20,
                bottom: 20,
                left: 50
            },

            xScale = d3.scale
                .linear()
                .range([MARGINS.left, WIDTH - MARGINS.right])
                .domain([ new Date(help.xDomMin), new Date(help.xDomMax) ]),

            yScale = d3.scale
                .linear()
                .range([HEIGHT - MARGINS.top, MARGINS.bottom])
                .domain([ help.yDomMin, help.yDomMax ]),

            xAxis = d3.svg.axis()
                .scale(xScale),

            yAxis = d3.svg.axis()
                .scale(yScale)
                .orient("left");

        /*vis.append("svg:g")
            .attr("transform", "translate(0," + (HEIGHT - MARGINS.bottom) + ")")
            .attr("class","axis")
            .call(xAxis);
        */

        vis.append("svg:g")
            .attr("transform", "translate(" + (MARGINS.left) + ",0)")
            .attr("class","axis")
            .call(yAxis);

        var lineGen = d3.svg.line()
            .x(function(d) {
                return xScale(new Date(d.date) );
            })
            .y(function(d) {
                return yScale(d.amount);
            })
            .interpolate("basis");

        vis.append('svg:path')
            .attr('d', lineGen(data) )
            .attr('stroke', 'green')
            .attr('stroke-width', 2)
            .attr('fill', 'none');


    </script>