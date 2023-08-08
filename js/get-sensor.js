let chart1;
let chart2;

document.getElementById('deviceForm').addEventListener('submit', function (event) {
  event.preventDefault();
  let device_id = document.getElementById('device').value;
  fetch('get_sensor.php?device_id=' + device_id)
    .then(response => response.json())
    .then(data => {
      // Display the latest sensor data
      let latestDataDiv = document.getElementById('latestData');
      latestDataDiv.innerHTML = '<h6 class="h4 fw-light text-gray-600 mb-3">Latest Sensor Data for ' + data[device_id].device_name + '</h6>' +
        '<div class="valueSensor">' +
        ' <p class="number">Humidity: ' + data[device_id].latest_sensor1_value + '</p>' +
        '<p class="number">Ph: ' + data[device_id].latest_sensor2_value + '</p>' +
        '</div>'

      // Create line charts for each sensor
      document.getElementById("btnHumidity").style.display = "block"; 
      document.getElementById("btnPh").style.display = "block";

      let ctx1 = document.getElementById('sensorChart1').getContext('2d');
      let ctx2 = document.getElementById('sensorChart2').getContext('2d');

      let options = {
        responsive: true,
        maintainAspectRatio: true,
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

      if (chart1) {
        chart1.destroy();
      }

      chart1 = new Chart(ctx1, {
        type: 'line',
        data: {
          datasets: [{
            label: 'Humidity',
            borderColor: 'rgba(75, 192, 192, 1)',
            data: data.sensor1.map(entry => ({ x: entry[0], y: entry[1] })),
            fill: false,
          }]
        },
        options: options
      });

      if (chart2) {
        chart2.destroy();
      }

      chart2 = new Chart(ctx2, {
        type: 'line',
        data: {
          datasets: [{
            label: 'Ph',
            borderColor: 'rgba(192, 75, 75, 1)',
            data: data.sensor2.map(entry => ({ x: entry[0], y: entry[1] })),
            fill: false,
          }]
        },
        options: options
      });
    });
});