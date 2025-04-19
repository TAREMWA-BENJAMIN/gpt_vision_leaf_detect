$(function() {
  'use strict';

  // Colors for charts
  var colors = {
      primary: '#6571ff',
      secondary: '#7987a1',
      success: '#05a34a',
      info: '#66d1d1',
      warning: '#fbbc06',
      danger: '#ff3366',
      light: '#e9ecef',
      dark: '#060c17',
      muted: '#7987a1',
      gridBorder: 'rgba(77, 138, 240, .15)',
      bodyColor: '#000',
      cardBg: '#fff'
  }

  // Initialize Feather Icons
  feather.replace();

  // Initialize Flatpickr
  if($('#dashboardDate').length) {
      flatpickr("#dashboardDate", {
          wrap: true,
          dateFormat: "d-M-Y",
          defaultDate: "today",
      });
  }

  // Charts Initialization
  // Customers Chart
  if($('#customersChart').length) {
      var options1 = {
          chart: {
              type: 'line',
              height: 80,
              sparkline: {
                  enabled: true
              }
          },
          series: [{
              data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54]
          }],
          stroke: {
              width: 2,
              curve: 'smooth'
          },
          markers: {
              size: 0
          },
          colors: [colors.primary],
          tooltip: {
              fixed: {
                  enabled: false
              },
              x: {
                  show: false
              },
              y: {
                  title: {
                      formatter: function (seriesName) {
                          return ''
                      }
                  }
              },
              marker: {
                  show: false
              }
          }
      }
      new ApexCharts(document.querySelector("#customersChart"), options1).render();
  }

  // Orders Chart
  if($('#ordersChart').length) {
      var options2 = {
          chart: {
              type: 'bar',
              height: 80,
              sparkline: {
                  enabled: true
              }
          },
          plotOptions: {
              bar: {
                  columnWidth: '50%'
              }
          },
          series: [{
              data: [36, 77, 52, 90, 74, 35, 55, 23, 47, 10, 63]
          }],
          colors: [colors.primary],
          tooltip: {
              fixed: {
                  enabled: false
              },
              x: {
                  show: false
              },
              y: {
                  title: {
                      formatter: function (seriesName) {
                          return ''
                      }
                  }
              },
              marker: {
                  show: false
              }
          }
      }
      new ApexCharts(document.querySelector("#ordersChart"), options2).render();
  }

  // Growth Chart
  if($('#growthChart').length) {
      var options3 = {
          chart: {
              type: 'line',
              height: 80,
              sparkline: {
                  enabled: true
              }
          },
          series: [{
              data: [41, 45, 44, 46, 52, 54, 43, 74, 82, 82, 89]
          }],
          stroke: {
              width: 2,
              curve: 'smooth'
          },
          markers: {
              size: 0
          },
          colors: [colors.primary],
          tooltip: {
              fixed: {
                  enabled: false
              },
              x: {
                  show: false
              },
              y: {
                  title: {
                      formatter: function (seriesName) {
                          return ''
                      }
                  }
              },
              marker: {
                  show: false
              }
          }
      }
      new ApexCharts(document.querySelector("#growthChart"), options3).render();
  }

  // Revenue Chart
  if($('#revenueChart').length) {
      var options4 = {
          chart: {
              type: 'line',
              height: 400,
              parentHeightOffset: 0,
              foreColor: colors.bodyColor,
              background: colors.cardBg,
              toolbar: {
                  show: false
              },
          },
          theme: {
              mode: 'light'
          },
          tooltip: {
              theme: 'light'
          },
          colors: [colors.primary],
          grid: {
              padding: {
                  bottom: -4
              },
              borderColor: colors.gridBorder,
              xaxis: {
                  lines: {
                      show: true
                  }
              }
          },
          series: [{
              name: 'Revenue',
              data: [
                  49.33, 48.79, 50.61, 53.31, 54.78, 53.84, 54.68, 56.74, 56.99, 56.14, 56.56, 60.35, 58.74, 61.44, 61.11, 58.57, 54.72, 52.07, 51.09, 47.48, 48.57, 48.99, 53.58, 50.28, 46.24, 48.61, 51.75, 51.34, 50.21, 54.65, 52.44, 53.06, 57.07, 52.97, 48.72, 52.69, 53.59
              ]
          }],
          xaxis: {
              type: 'datetime',
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
              axisBorder: {
                  color: colors.gridBorder,
              },
              axisTicks: {
                  color: colors.gridBorder,
              },
          },
          yaxis: {
              title: {
                  text: 'Revenue ( $1000 x )',
                  style:{
                      size: 9,
                      color: colors.muted
                  }
              },
          },
          legend: {
              show: true,
              position: 'top',
              horizontalAlign: 'center',
              fontFamily: "'Roboto', sans-serif",
              itemMargin: {
                  horizontal: 8,
                  vertical: 0
              },
          },
          stroke: {
              width: 3,
              curve: 'smooth'
          },
          dataLabels: {
              enabled: false
          },
      }
      var apexLineChart = new ApexCharts(document.querySelector("#revenueChart"), options4);
      apexLineChart.render();
  }

  // Monthly Sales Chart
  if($('#monthlySalesChart').length) {
      var options5 = {
          chart: {
              type: 'bar',
              height: 260,
              parentHeightOffset: 0,
              foreColor: colors.bodyColor,
              background: colors.cardBg,
              toolbar: {
                  show: false
              },
          },
          theme: {
              mode: 'light'
          },
          tooltip: {
              theme: 'light'
          },
          colors: [colors.primary],
          fill: {
              opacity: .9
          },
          grid: {
              padding: {
                  bottom: -4
              },
              borderColor: colors.gridBorder,
              xaxis: {
                  lines: {
                      show: true
                  }
              }
          },
          series: [{
              name: 'Sales',
              data: [152,109,93,113,126,161,188,143,102,113,116,124]
          }],
          xaxis: {
              type: 'datetime',
              categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
              axisBorder: {
                  color: colors.gridBorder,
              },
              axisTicks: {
                  color: colors.gridBorder,
              },
          },
          yaxis: {
              title: {
                  text: 'Number of Sales',
                  style:{
                      size: 9,
                      color: colors.muted
                  }
              },
          },
          legend: {
              show: true,
              position: 'top',
              horizontalAlign: 'center',
              fontFamily: "'Roboto', sans-serif",
              itemMargin: {
                  horizontal: 8,
                  vertical: 0
              },
          },
          stroke: {
              width: 0
          },
          dataLabels: {
              enabled: true,
              style: {
                  fontSize: '10px',
                  fontFamily: "'Roboto', sans-serif",
              }
          }
      }
      var apexBarChart = new ApexCharts(document.querySelector("#monthlySalesChart"), options5);
      apexBarChart.render();
  }

  // Cloud Storage Chart
  if($('#storageChart').length) {
      var options6 = {
          chart: {
              height: 260,
              type: 'radialBar'
          },
          series: [67],
          colors: [colors.primary],
          plotOptions: {
              radialBar: {
                  hollow: {
                      margin: 15,
                      size: '70%'
                  },
                  track: {
                      show: true,
                      background: colors.light,
                      strokeWidth: '100%',
                      opacity: 1,
                      margin: 5,
                  },
                  dataLabels: {
                      showOn: 'always',
                      name: {
                          offsetY: -11,
                          show: true,
                          color: colors.muted,
                          fontSize: '13px'
                      },
                      value: {
                          color: colors.bodyColor,
                          fontSize: '30px',
                          show: true
                      }
                  }
              }
          },
          fill: {
              opacity: 1
          },
          stroke: {
              lineCap: 'round',
          },
          labels: ['Storage Used'],
      }
      
      var apexRadialChart = new ApexCharts(document.querySelector("#storageChart"), options6);
      apexRadialChart.render();
  }
});