function printReport() {
    let table = document.querySelector('.data-table').outerHTML;
    let newWin = window.open('', '', 'width=900,height=600');
    newWin.document.write('<html><head><title>Service Orders Report</title>');
    newWin.document.write('<style>table { width: 100%; border-collapse: collapse; } table, th, td { border: 1px solid black; padding:5px; } th { background:#f0f0f0; }</style>');
    newWin.document.write('</head><body>');
    newWin.document.write('<h2>Service Orders Report (Ready for Release)</h2>');
    newWin.document.write(table);
    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.print();
}