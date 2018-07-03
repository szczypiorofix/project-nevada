// import { TableData } from './tabledata';

// class TableDrawer {

//     private static data:TableData[] = null;

//     private static draw(data: TableData[]) {
//         let body = '<table><thead><tr><th>ID</th><th>Imię</th><th>Wynik</th></tr></thead><tbody>';
//         data.forEach(element => {
//             body += '<tr><td>'+element.id+'</td><td>'+element.name+'</td><td>'+element.score+'</td></tr>';
//         });
//         body += '</tbody></table>';
//         return body
//     }

//     private static async start(resp) {
//         this.data = JSON.parse(resp);
//         console.log(this.data);
//         let tableContainer:HTMLElement = document.getElementById('tequila-best-scores');
//         tableContainer.innerHTML = this.draw(this.data);
//     }

//     public static run() {
//         let xhttp = new XMLHttpRequest();
//         let self = this;
//         xhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 self.start(this.responseText);
//             }
//         };
//         xhttp.open("GET", "projekt/tequila/getresults", true);
//         xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xhttp.send();
//     }
// }

// TableDrawer.run();

declare var agGrid:any;

var columnDefs = [
    {headerName: "Make", field: "make"},
    {headerName: "Model", field: "model"},
    {headerName: "Price", field: "price"}
  ];
  
  // specify the data
  var rowData = [
    {make: "Toyota", model: "Celica", price: 35000},
    {make: "Ford", model: "Mondeo", price: 32000},
    {make: "Porsche", model: "Boxter", price: 72000}
  ];
  
  // let the grid know which columns and what data to use
  var gridOptions = {
    columnDefs: columnDefs,
    rowData: rowData
  };

// lookup the container we want the Grid to use
var eGridDiv = document.querySelector('#tequila-best-scores');

// create the grid passing in the div to use together with the columns & data we want to use
new agGrid.Grid(eGridDiv, gridOptions);

