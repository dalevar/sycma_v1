// let presensiJurusanKelasElement = document.getElementById("presensiJurusanKelas");

// let options = {
//     series: [
//         {
//             name: "Laki - Laki",
//             data: [24, 25,22, 112,],
//         },
//         {
//             name: "Perempuan",
//             data: [24, 25, 21, 198,],
//         },
//     ],
//     chart: {
//         type: "bar",
//         height: 350,
//     },
//     plotOptions: {
//         bar: {
//             horizontal: false,
//             columnWidth: "55%",
//             endingShape: "rounded",
//         },
//     },
//     dataLabels: {
//         enabled: false,
//     },
//     stroke: {
//         show: true,
//         width: 2,
//         colors: ["transparent"],
//     },
//     xaxis: {
//         categories: ["Senin", "Selasa", "Rabu", "Kamis"],
//     },
//     yaxis: {
//         title: {
//             text: "Jumlah Presensi",
//         },
//     },
//     fill: {
//         opacity: 1,
//     },
//     tooltip: {
//         y: {
//             formatter: function (val) {
//                 return val + " Siswa";
//             },
//         },
//     },
//     colors: ["#696CFF", "#FF9561"], // Warna untuk "Laki - Laki" dan "Perempuan"
// };

// var chart = new ApexCharts(presensiJurusanKelasElement, options);
// chart.render();

let totalPresensiElement = document.getElementById("totalPresensi");
let options = {
    series: [44, 55],
    chart: {
    width: 380,
    type: 'pie',
  },
  labels: ['Laki-Laki', 'Perempuan'],
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
  };


var chart = new ApexCharts(totalPresensiElement, options);
chart.render();
