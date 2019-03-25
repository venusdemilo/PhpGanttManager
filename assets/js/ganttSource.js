
$(document).ready(function() {
  $('#modal1').modal();
  $('#from').datepicker({
    autoClose:true,
    container:$('#datepickercontainer'),

  });
  $('#to').datepicker({
    autoClose:true,
    container:$('#datepickercontainer'),

  });
// #####################################@
// array to convert getMonth() method result
var nameMonth = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];


$('#chargerjson').click(function(){
modifierGantt();
});

//initialisation variable stockage données
var tanker = $('body');
//affectation données dans variable 'data_1' sur 'body'
// sous forme d'objet JS
// 'jsonrecept' est définie dans le template
$.getJSON(jsonrecept, function(json){
  $.data(tanker,'data_1',{obj_1:json});
});


// appel chargement gantt
$('#chargergantt').click(function(){
  var json = $.data(tanker,'data_1').obj_1;
  var dateFrom = new Date().getTime();
  var dateTo = dateFrom + (7*86400000);
  for (var i=0; i<json.length; i++){
    json[i].values[0].from = dateFrom;
    json[i].values[0].to = dateTo;
  }
  
  chargerGantt(json);
});
// func modify gantt
function modifierGantt(){
  var json = $.data(tanker,'data_1').obj_1;
  json[0].name = 'coco';
  console.log(json[0].name);
}
//func form submit
$('#submitData').click(function(e){
  dateTo = Date.parse($('#to:input').val());
  dateFrom = Date.parse($('#from:input').val());
  var json = $.data(tanker,'data_1').obj_1;
  if($('#flag:input').val() == "modify")
  {

    json[$('#idNumber').val()].name = $('#name:input').val();
    json[$('#idNumber').val()].desc = $('#desc:input').val();
    json[$('#idNumber').val()].values[0].to = dateTo;
    json[$('#idNumber').val()].values[0].from = dateFrom;
    json[$('#idNumber').val()].values[0].desc = $('#desc2:input').val();
    json[$('#idNumber').val()].values[0].label = $('#label:input').val();
    json[$('#idNumber').val()].values[0].dataObj.completed = $("input[name='completed']:checked").val();
    json[$('#idNumber').val()].values[0].customClass = $('#customClass:input').val();
    json[$('#idNumber').val()].values[0].dataObj.access = $('#access:input').val();
    if ($("input[name='completed']:checked").val() == 'true'){
      json[$('#idNumber').val()].desc = 'x ' + json[$('#idNumber').val()].desc;
     }
      else
      {
        var str = json[$('#idNumber').val()].desc;
        str = str.replace("x","");
        json[$('#idNumber').val()].desc = str;
      }
  }
 else
  {

    console.log('ajout');
    json.push(
      {
        name: $('#name:input').val(),
        desc: $('#desc:input').val(),
        values: [{
          to: dateTo,
          from: dateFrom,
          desc: $('#desc2:input').val(),
          label: $('#label:input').val(),
          customClass: $('#customClass:input').val() ,
          dataObj:{
            "id": $('#idNumber:input').val(),
            "completed": $("input[name='completed']:checked").val()
          }

        }]
      }
    );

  }

  $('#modal1').modal('close');
  var dataToSend = JSON.stringify(json);
  // jsonsend est défini dans le template
  $.post(jsonsend, {objet:dataToSend});

  console.log(dataToSend);
  chargerGantt(json);
});
// func chargement du gantt
function chargerGantt(source){

  $(".gantt").gantt({
  source:  source ,
  scale: "days",
	minScale: "days",
	maxScale: "months",
  navigate: "scroll",
  months :  	["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"],
  dow :  	["D", "L", "Ma", "Me", "J", "V", "S"],
  scrollToToday: true,
  itemsPerPage: 50,
  waitText: "Mise à jour ...",
  onItemClick: function(data) {

    $('#formtitle').text('Modifier tâche');
    $('#submitData').text('Modifier');
    var json = $.data(tanker,'data_1').obj_1;
    console.log(data.id);
    var id = json[data.id];

    var dateTo = new Date(parseInt(id.values[0].to));
    var dateFrom = new Date(parseInt(id.values[0].from));

    dateTo =  nameMonth[dateTo.getMonth()]+ ' ' + dateTo.getDate()  + ', ' + dateTo.getFullYear();
    dateFrom = nameMonth[dateFrom.getMonth()]+ ' ' + dateFrom.getDate()  + ', ' + dateFrom.getFullYear();
    $('#name:input').val(id.name);
    $('#desc:input').val(id.desc);
    $('#to:input').val(dateTo);
    $('#from:input').val(dateFrom);
    $('#idNumber').val(id.values[0].dataObj.id);
    $('#flag:input').val('modify');
    $('#desc2:input').val(id.values[0].desc);
    $('#label:input').val(id.values[0].label);
    $('#customClass:input').val(id.values[0].customClass);
    $('#access:input').val(id.values[0].dataObj.access);
    //$('#completed:checkbox').val(id.values[0].dataObj.completed);
    //confirm('Tâche achevée :' + id.values[0].dataObj.completed);
    if (id.values[0].dataObj.completed == 'true')
    {
      $('#radiotrue:input').prop("checked",true);
      $('#radiofalse:input').prop("checked",false);
    }
    else
    {
      $('#radiofalse:input').prop("checked",true);
    }

    $('#modal1').modal('open');
  // end onItemClick
	},
	onAddClick: function(dt, rowId) {
    var json = $.data(tanker,'data_1').obj_1;
    var nbItem = json.length;
    console.log(nbItem + ' items dans le json')
    var dateFrom = new Date().getTime();
    console.log('Date départ :' + dateFrom);
    // ajout de 7 jours
    var dateTo = dateFrom + (7*86400000);
    dateTo = new Date(parseInt(dateTo));
    dateFrom = new Date(parseInt(dateFrom));
    console.log('Date fin :' + dateTo);
    dateFrom = nameMonth[dateFrom.getMonth()]+ ' ' + dateFrom.getDate()  + ', ' + dateFrom.getFullYear();
    dateTo =  nameMonth[dateTo.getMonth()]+ ' ' + dateTo.getDate()  + ', ' + dateTo.getFullYear();



  $('#formtitle').text('Ajouter tâche');
  $('#submitData').html('Ajouter');
  // form purge
  $('#name:input').val('');
  $('#desc:input').val('');
  $('#to:input').val(dateTo);
  $('#from:input').val(dateFrom);
  $('#idNumber').val('');
  $('#desc2:input').val('');
  $('#label:input').val('');
  $('#customClass:input').val('');
  $('#access:input').val('');
  // set flag and idNumber
  $('#flag:input').val('add');
  $('#idNumber:input').val(nbItem);

  $('#modal1').modal('open');

    console.log(nbItem);
	}, // end onAddClick
	onRender: function() {
	}
  });
} //end func chargerGantt


});
