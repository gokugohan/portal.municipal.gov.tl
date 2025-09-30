function renderChart(data, canvas, title = "", chartType = null) {

    let chart_type = chartType == null ? data.chart_type : chartType;
    Highcharts.chart(canvas, {

        chart: {
            type: chart_type //data.chart_type
        },
        title: {text: data.title},
        subtitle: {
            text: data.source,
        },
        xAxis: {
            type: 'category', // Force categories
            title: {text: data.x_axis},
            labels: {
                autoRotation: [-45, -90],
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {text: data.y_axis}
        },
        credits: {
            text: 'Portal Munisipal',
            // href: 'https://portal.municipio.gov.tl',
        },
        data: {
            csv: data.content.replace(/[\\*]/g, ''),
            parsed: function (columns) {
                columns[0] = columns[0].map(String); // Ensure first column is treated as text
            }
        },
        legend: {
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        formatter: function () {
            if (this.y > 1000000) {
                return Highcharts.numberFormat(this.y / 1000, 3) + "M"
            } else if (this.y > 1000) {
                return Highcharts.numberFormat(this.y / 1000, 3) + "K";
            } else {
                return this.y
            }
        },

        tooltip: {
            headerFormat: '',
            pointFormat: `<span style="color:{point.color}">\u25CF</span>
                    {point.name}: <b>{Highcharts.numberFormat(point.y)}</b><br/>`
        },
       
        exporting: {
            enabled: true,
            buttons: {
                contextButton: {
                    menuItems: [
                        'downloadPNG',
                        'downloadJPEG',
                        'separator',
                        'downloadCSV',
                        'viewFullscreen',
                    ]
                }
            }
        }

    });
}

function format_number(number, is_currency) {
    let option = {};
    if (is_currency === "1") {
        option = {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        };
    }
    return new Intl.NumberFormat('en-US', option).format(number);
}
