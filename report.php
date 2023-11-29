<?php include 'db_connect.php' ?>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card mt-5">
            <div class="card-header" style="background-color: #036bfc; text-align:center; color:white;">
              <h4>REPORT</h4>
            </div>
            <div class="card-body">
                    
             <form>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>From Date</label>
                      <input type="date" id="from_date" value="<?php if(isset($_GET['from_date'])){ echo $_GET['from_date']; } ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>To Date</label>
                      <input type="date" id="to_date" value="<?php if(isset($_GET['to_date'])){ echo $_GET['to_date']; } ?>" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-1" style="margin-top: 30px; max-width: 110px">
                    <div class="form-group">
                      <!-- <label>Click here to search</label> <br> -->
                      <button type="button" id="search_btn" class="btn btn-primary">Search</button>
                    </div>
                  </div>
                  <div class="col-md-2" style="margin-top: 30px">
                    <div class="form-group">
                      <!-- <label>Click here to search</label> <br> -->
                      <button type="button" onclick = "exportData()" class="btn btn-primary">Download Excel</button>
                    </div>
                  </div>
                  
                </div>
              </form>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <table id="tbldata" class="table table-bordered">
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Invoice No</th>
                    <th>Customer Name</th>
                    <th>Net Amount</th>
                    <th>GST Amount</th>
                    <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                    </tbody>
                  </table>
                  <div style="text-align:center;" id="content"></div>
                  <!-- <div style="text-align:center;">
              <h6>No Results Found</h6>
            </div> -->
                </div>
                </div>
                <div class="total" style="display:flex;justify-content:space-evenly;background-color:white;font-weight:bold; height:80px;">
          <div class="style">
            <style>
             .box{
                text-align:center;
                margin:auto;
                height:40px;
                box-shadow:2px 2px 2px rgba(0,0,0,0.5);
                padding:10px;
                border-radius:5px;
              }
            </style>
            </div>
            <div id="t_net_amt" class="alert alert-info box">Net Amount : ₹ 0</div>
            <div id="t_cgst_amt" class="alert alert-info box">CGST Amount : ₹ 0</div>
            <div id="t_sgst_amt" class="alert alert-info box">SGST Amount : ₹ 0</div>
            <div id="t_tot_amt" class="alert alert-info box">Total Amount : ₹ 0</div>
          </div>

          </div>
              </div>
            </div>
		      </div>
        </div>
      </div>
    </div>

    <script>
    $('#search_btn').click(function(){
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      $.ajax({
        url:'ajax.php?action=sales_report',
        data:{fromdate:from_date,todate:to_date},
          method: 'POST',
        success:function(resp){
          resp = JSON.parse(resp);
              var el = document.getElementById('content');
              var content;
              var net_amt = 0;
              var gst_amt = 0;
              var tot_amt = 0;
              var user = false
            if(resp.status){
              var alldata = resp.data
              user = true
              if(user) {
                  content = '<h6>'.concat(alldata.length ,' Results Found</h6>');
              }
              for(i=0;i<alldata.length;i++)
              {
                alldata[i]['s_no'] = i+1
                net_amt+=parseFloat(alldata[i]['net_amount']);
                gst_amt+=parseFloat(alldata[i]['gst_amount']);
                tot_amt+=parseFloat(alldata[i]['total_amount']);
                const tableData = alldata.map(function(value){
                  var newdate = formatDate(value.date_created)
                  var s_id = i+1
                  function formatDate(date) {
                      var d = new Date(date),
                          month = '' + (d.getMonth() + 1),
                          day = '' + d.getDate(),
                          year = d.getFullYear();
                      if (month.length < 2) 
                          month = '0' + month;
                      if (day.length < 2) 
                          day = '0' + day;

                      return [day, month, year].join('-');
                  }
                return (
                    `<tr>
                        <td>${value.s_no}</td>
                        <td>${newdate}</td>
                        <td>${value.ref_no}</td>
                        <td>${value.name}</td>
                        <td>${value.net_amount}</td>
                        <td>${value.gst_amount}</td>
                        <td>${value.total_amount}</td>
                    </tr>`
                );
            }).join('');
            const tabelBody = document.querySelector("#tableBody");
            tableBody.innerHTML = tableData;
          }
            }else{
              user = true
              if(user) {
                  content = '<h6>No Results Found</h6>';
              }  
            const tabelBody = document.querySelector("#tableBody");
            tableBody.innerHTML = null;
              alert_toast(resp.message,'danger')
            }
            document.getElementById("content").innerHTML = content
            document.getElementById("t_net_amt").innerHTML = 'Net Amount : ₹ '+net_amt
            document.getElementById("t_cgst_amt").innerHTML = 'CGST Amount : ₹ ' +gst_amt/2
            document.getElementById("t_sgst_amt").innerHTML = 'SGST Amount : ₹ ' +gst_amt/2
            document.getElementById("t_tot_amt").innerHTML = 'Total Amount : ₹ ' +tot_amt
        }
        })
    })

    function exportData(){
    /* Get the HTML data using Element by Id */
    var table = document.getElementById("tbldata");
    /* Declaring array variable */
    var rows =[];
      //iterate through rows of table
    for(var i=0,row; row = table.rows[i];i++){
        //rows would be accessed using the "row" variable assigned in the for loop
        //Get each cell value/column from the row
        column1 = row.cells[0].innerText;
        column2 = row.cells[1].innerText;
        column3 = row.cells[2].innerText;
        column4 = row.cells[3].innerText;
        column5 = row.cells[4].innerText;
        column6 = row.cells[5].innerText;
        column7 = row.cells[6].innerText;
    /* add a new records in the array */
        rows.push(
            [
                column1,
                column2,
                column3,
                column4,
                column5,
                column6,
                column7
            ]
        );
 
        }
        csvContent = "data:text/csv;charset=utf-8,";
         /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray){
            row = rowArray.join(",");
            csvContent += row + "\r\n";
        });

        if(rows.length <= 1)
        {
          alert_toast("Data is Empty",'danger')
        }
        else{
          /* create a hidden <a> DOM node and set its download attribute */
          var encodedUri = encodeURI(csvContent);
          var link = document.createElement("a");
          link.setAttribute("href", encodedUri);
          link.setAttribute("download", "TT_Report.csv");
          document.body.appendChild(link);
          link.click();
        }

}

  </script>
