$(function() {
  'use strict';

  // Chart colors
  const chartColors = {
    primary: '#4e73df',
    success: '#1cc88a',
    info: '#36b9cc',
    warning: '#f6c23e',
    danger: '#e74a3b',
    secondary: '#858796',
    light: '#f8f9fc',
    dark: '#5a5c69'
  };

  // Chart options
  const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'bottom'
      }
    }
  };

  console.log('Initializing charts...');

  // Initialize all charts
  function initializeCharts() {
    // Fetch chart data from the server
    fetch('/dashboard/chart-data')
      .then(response => response.json())
      .then(data => {
        initializeDiseaseTrendsChart(data.diseaseTrends);
        initializeTopDiseasesChart(data.topDiseases);
        initializeCropDistributionChart(data.cropDistribution);
        initializeUserGrowthChart(data.userGrowth);
      })
      .catch(error => console.error('Error fetching chart data:', error));
  }

  // Disease Detection Trends Chart (Line Chart)
  function initializeDiseaseTrendsChart(data) {
    const ctx = document.getElementById('diseaseTrendsChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Number of Scans',
          data: data.data,
          borderColor: chartColors.primary,
          backgroundColor: 'rgba(78, 115, 223, 0.1)',
          borderWidth: 2,
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        ...chartOptions,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Number of Scans'
            }
          }
        }
      }
    });
  }

  // Top Detected Diseases Chart (Bar Chart)
  function initializeTopDiseasesChart(data) {
    const ctx = document.getElementById('topDiseasesChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Number of Detections',
          data: data.data,
          backgroundColor: [
            chartColors.primary,
            chartColors.success,
            chartColors.info,
            chartColors.warning,
            chartColors.danger
          ]
        }]
      },
      options: {
        ...chartOptions,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Number of Detections'
            }
          }
        }
      }
    });
  }

  // Scan Distribution by Crop Type Chart (Pie Chart)
  function initializeCropDistributionChart(data) {
    const ctx = document.getElementById('cropDistributionChart').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: data.labels,
        datasets: [{
          data: data.data,
          backgroundColor: [
            chartColors.primary,
            chartColors.success,
            chartColors.info,
            chartColors.warning,
            chartColors.danger
          ]
        }]
      },
      options: chartOptions
    });
  }

  // User Growth Over Time Chart (Line Chart)
  function initializeUserGrowthChart(data) {
    const ctx = document.getElementById('userGrowthChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Number of Users',
          data: data.data,
          borderColor: chartColors.success,
          backgroundColor: 'rgba(28, 200, 138, 0.1)',
          borderWidth: 2,
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        ...chartOptions,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Number of Users'
            }
          }
        }
      }
    });
  }

  // Initialize charts when the document is ready
  document.addEventListener('DOMContentLoaded', initializeCharts);
}); 