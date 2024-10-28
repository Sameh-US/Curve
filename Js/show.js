window.onload = function () {
        
    createCurve();


    };
    $DataTable = []; // المتغير المسئول عن جمع البيانات من الجدول
    // الدالة المسئولة عن تعبئة الكيرف
    const createCurve = function() {
        getDataFromTable();
        var chart = new CanvasJS.Chart("chartContainer", {
            exportEnabled: true,
            animationEnabled: true,
            title: {
                text: "General diagram of the minimum ventilation and maximum ventilation curve",
            },
            axisX: {
                valueFormatString: "",
            },
            axisY: {
                title: "Ventilation Ratio (%)",
                suffix: " %",
            },
            data: [{
                type: "rangeSplineArea",
                indexLabel: "{y[#index]}%",
                xValueFormatString: "Day 0",
                toolTipContent: "{x} </br> <strong>Ventilation: </strong> </br> Min: {y[0]} %, Max: {y[1]} %",

                dataPoints: [{
                        x: new Number($DataTable[1][1]),
                        y: [$DataTable[1][3], $DataTable[1][4]],
                    },
                    {
                        x: new Number($DataTable[2][1]),
                        y: [$DataTable[2][3], $DataTable[2][4]],
                    },
                    {
                        x: new Number($DataTable[3][1]),
                        y: [$DataTable[3][3], $DataTable[3][4]],
                    },
                    {
                        x: new Number($DataTable[4][1]),
                        y: [$DataTable[4][3], $DataTable[4][4]],
                    },
                    {
                        x: new Number($DataTable[5][1]),
                        y: [$DataTable[5][3], $DataTable[5][4]],
                    },
                    {
                        x: new Number($DataTable[6][1]),
                        y: [$DataTable[6][3], $DataTable[6][4]],
                    },
                    {
                        x: new Number($DataTable[7][1]),
                        y: [$DataTable[7][3], $DataTable[7][4]],
                    },
                    {
                        x: new Number($DataTable[8][1]),
                        y: [$DataTable[8][3], $DataTable[8][4]],
                    },
                    {
                        x: new Number($DataTable[9][1]),
                        y: [$DataTable[9][3], $DataTable[9][4]],
                    },
                    {
                        x: new Number($DataTable[10][1]),
                        y: [$DataTable[10][3], $DataTable[10][4]],
                    },
                ],
            }, ],
        });
        chart.render();


        

};
