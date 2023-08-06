function exportToCSV(chartId) {
  let chart = Chart.getChart(chartId);
  let data = chart.data.datasets[0].data;
  let csvContent = "data:text/csv;charset=utf-8,";

  data.forEach(function (entry) {
    csvContent += entry.x + "," + entry.y + "\n";
  });

  let encodedUri = encodeURI(csvContent);
  let link = document.createElement("a");
  link.setAttribute("href", encodedUri);
  link.setAttribute("download", chartId + ".csv");
  document.body.appendChild(link);
  link.click();
}