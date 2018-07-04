class TableDrawer {
    static run() {
        let gridOptions = {
            rowData: this.data,
            enableSorting: true,
            enableFilter: true,
            columnDefs: [
                { headerName: "Imię", field: "name", minWidth: 150, width: 200, maxWidth: 350 },
                { headerName: "Wynik", field: "score", minWidth: 150, width: 150, maxWidth: 150 },
                { headerName: "Poziom", field: "level", minWidth: 120, width: 120, maxWidth: 150 },
                { headerName: "Czas", field: "millis", minWidth: 100, width: 100, maxWidth: 150 },
                { headerName: "Data", field: "insert_date", minWidth: 200, width: 200, maxWidth: 200 }
            ],
            defaultColDef: {
                width: 100,
                editable: false,
                filter: 'agTextColumnFilter'
            },
            gridAutoHeight: true,
        };
        let eGridDiv = document.querySelector('#tequila-best-scores');
        new agGrid.Grid(eGridDiv, gridOptions);
        fetch('projekt/tequila/getresults').then(function (response) {
            return response.json();
        }).then(function (data) {
            data.forEach(element => {
                let min = element.millis / 60000;
                let sec = (element.millis / 1000) % 60;
                min = Math.round(min);
                sec = Math.round(sec);
                if (sec < 10)
                    sec = '0' + sec;
                element.millis = min + ':' + sec;
            });
            gridOptions.api.setRowData(data);
            // eGridDiv.style.width = '400px';
            // eGridDiv.style.height = '400px';
            // gridOptions.api.doLayout();
        });
    }
}
TableDrawer.data = null;
TableDrawer.run();
//# sourceMappingURL=tequila.js.map