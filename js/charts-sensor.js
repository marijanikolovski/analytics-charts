/*document.querySelector('form').addEventListener('submit', function (event) {
  event.preventDefault();
  var device_id = document.getElementById('device').value;
  fetch('get_sensor.php?device_id=' + device_id)
    .then(response => response.json())
    .then(data => {
      var ctx1 = document.getElementById('sensorChart1').getContext('2d');
      var ctx2 = document.getElementById('sensorChart2').getContext('2d');

      var options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            type: 'linear',
            position: 'bottom'
          },
          y: {
            type: 'time',
            time: {
              unit: 'hour'
            }
          }
        }
      };

      var chart1 = new Chart(ctx1, {
        type: 'line',
        data: {
          datasets: [{
            label: 'Humidity',
            borderColor: 'rgba(75, 192, 192, 1)',
            data: data.sensor1?.map(entry => ({ x: entry['value'], y: entry['timestamp'] })),
            fill: false,
          }]
        },
        options: options
      });

      var chart2 = new Chart(ctx2, {
        type: 'line',
        data: {
          datasets: [{
            label: 'Ph',
            borderColor: 'rgba(192, 75, 75, 1)',
            data: data.sensor2?.map(entry => ({ x: entry['value'], y: entry['timestamp'] })),
            fill: false,
          }]
        },
        options: options
      });
    });
});*/

document.querySelector('form').addEventListener('submit', function (event) {
  event.preventDefault();
  var device_id = document.getElementById('device').value;
  fetch('get_sensor.php?device_id=' + device_id)
    .then(response => response.json())
    .then(data => {
      // Create line charts for each sensor
      var ctx1 = document.getElementById('sensorChart1').getContext('2d');
      var ctx2 = document.getElementById('sensorChart2').getContext('2d');

      var options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          x: {
            type: 'linear',
            position: 'bottom'
          },
          y: {
            type: 'time',
            time: {
              unit: 'hour'
            }
          }
        }
      };

      var chart1 = new Chart(ctx1, {
        type: 'line',
        data: {
          datasets: [{
            label: 'Sensor1',
            borderColor: 'rgba(75, 192, 192, 1)',
            data: data.sensor1.map(entry => ({ x: entry[0], y: new Date(entry[1]) })),
            fill: false,
          }]
        },
        options: options
      });

      var chart2 = new Chart(ctx2, {
        type: 'line',
        data: {
          datasets: [{
            label: 'Sensor2',
            borderColor: 'rgba(192, 75, 75, 1)',
            data: data.sensor2.map(entry => ({ x: entry[0], y: new Date(entry[1]) })),
            fill: false,
          }]
        },
        options: options
      });
    });
});
