
  window.onload = function () {

    const canvas = document.getElementById("chartContainer"); // Récupère le canvas
    const nb = canvas.className.split("_");

    let validenb = nb[0];
    let nonvalidenb = nb[1];
    let totalnb = nb[2];


    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Status des hôtels "
      },
      axisY: {
				tickLength: 15,
                tickColor: "DarkSlateBlue" ,
                tickThickness: 5
      },
      data: [

      {
        type: "column", 

        dataPoints: [
        { y: parseInt(totalnb), label: "Total"},
        { y: parseInt(validenb),  label: "Valide" },
        { y: parseInt(nonvalidenb),  label: "Non valide"},		
        ]
      }
      ]
    });
    chart.render();

    const canvasuser = document.getElementById("chartuser"); // Récupère le canvas
    const nbuser = canvasuser.className.split("_");
   
    var date = new Date();

    date1month = date.setMonth((date.getMonth())-1);
    date2month = date.setMonth((date.getMonth())-2);


  var chart1 = new CanvasJS.Chart("chartuser",
    {
    
      title:{
      text: "Evolution du nombre d'inscrit"
      },
       axisY: {
				tickLength: 15,
                tickColor: "DarkSlateBlue" ,
                tickThickness: 5
      },
      axisX: {
        valueFormatString: "MMM",
        interval: 1,
        intervalType: "month"
      },
       data: [
      {        
        type: "spline",
        
        dataPoints: [
        { x: date2month, y: parseInt(nbuser[2]) },
        { x: date1month, y: parseInt(nbuser[1]) },
        { x: new Date(), y: parseInt(nbuser[0]) },
          
        ]
      }       
        
      ]
    });



        chart1.render();
  }
