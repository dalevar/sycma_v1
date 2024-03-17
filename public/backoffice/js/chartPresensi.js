let presensiJurusanKelasElement = document.getElementById("presensiJurusanKelas");

let options = {
    series: [
        {
            name: "Laki - Laki",
            data: [44, 55, 57, 56,],
        },
        {
            name: "Perempuan",
            data: [76, 85, 101, 98,],
        },
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
    },
    xaxis: {
        categories: ["Senin", "Selasa", "Rabu", "Kamis"],
    },
    yaxis: {
        title: {
            text: "Jumlah Presensi",
        },
    },
    fill: {
        opacity: 1,
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return "$ " + val + " thousands";
            },
        },
    },
    colors: ["#696CFF", "#FF9561"], // Warna untuk "Laki - Laki" dan "Perempuan"
};

var chart = new ApexCharts(presensiJurusanKelasElement, options);
chart.render();




let totalPresensiElement = document.getElementById("totalPresensi");
let options2 = {
    series: [
        {
            name: "Laki - Laki",
            data: [44, 55, 57, 56,],
        },
        {
            name: "Perempuan",
            data: [76, 85, 101, 98,],
        },
    ],
    chart: {
        type: "bar",
        height: 350,
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
    },
    xaxis: {
        categories: ["Senin", "Selasa", "Rabu", "Kamis"],
    },
    yaxis: {
        title: {
            text: "Jumlah Presensi",
        },
    },
    fill: {
        opacity: 1,
    },
    tooltip: {
        y: {
            formatter: function (val) {
                return "$ " + val + " thousands";
            },
        },
    },
    colors: ["#696CFF", "#FF9561"], // Warna untuk "Laki - Laki" dan "Perempuan"
};

var chart = new ApexCharts(totalPresensiElement, options2);
chart.render();
