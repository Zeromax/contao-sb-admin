(function ($) {
    $(function () {
        logChart = new Morris.Line({
            element: 'log-chart',
            data: logChartData,
            xkey: logChartKey,
            ykeys: logChartKeys,
            lineColors: logChartLineColors,
            labels: logChartLabels,
            hideHover: true,
            resize: true
        }).on('click', function (i, row) {
                $('#log-chart-tstamp').val(row.tstamp);
                $('#form-filter-log').submit();
            });
        $('#log-chart-filter input[type="checkbox"]').on('click', function() {
            redrawChart();
        });
        $('#reset-log-chart-filter').on('click', function(e) {
            $.each($('#log-chart-filter input[type="checkbox"]'), function() {
                $(this).prop('checked', true);
            });
            redrawChart();
            e.preventDefault();
        });
    });
    function redrawChart() {
        var arrFilter = [];
        var arrFilterData = [];
        $.each($('#log-chart-filter input[type="checkbox"]:checked'), function(i, item) {
            arrFilter.push(parseInt($(item).val()));
            arrFilterData.push($(item).prop('name'));
        });
        logChart.options.ykeys = arrayWalk(logChartKeys, arrFilter);
        logChart.options.lineColors = arrayWalk(logChartLineColors, arrFilter);
        logChart.options.labels = arrayWalk(logChartLabels, arrFilter);

        var chartData = logChartData;
        $.each(chartData, function(index, item) {
            $.each(arrFilterData, function(i, item) {
                if ($.inArray(item, arrFilterData) < 0) {
                    delete chartData[index][item];
                }
            });
        });
        logChart.setData(chartData);
    }
    function arrayWalk(arrValue, arrFilter) {
        var returnValue = [];
        $.each(arrValue, function(i, item) {
            if ($.inArray(i, arrFilter) > -1) {
                returnValue.push(item);
            }
        });
        return returnValue;
    }
})(jQuery);