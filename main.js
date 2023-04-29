$(function(){

    let listDep=$('#listDep');

    listDep.click(function(){
        console.log(listDep.val())
        $.get('http://localhost/pfe_absences/data/filiers.php?dep='+listDep.val(),function(data){

        data=JSON.parse(data)
        console.log(data)
        //
        data.forEach((dd)=>{
            let s="<option value='"+dd.ID_FILIERE_+"' >"+dd.NOM_FILIERE_+"</option>"
            $("#listFilier").append(s)

        })
            })
    })
    
})

$(function(){

    let inputState=$('#inputState');

    inputState.click(function(){
        console.log(inputState.val())
        $.get('http://localhost/pfe_absences/data/filiers.php?grop='+inputState.val(),function(data){

        data=JSON.parse(data)
        console.log(data)
        //
        data.forEach((dd)=>{
            let s="<option value='"+dd.ID_GROUPE+"' >"+dd.NOM_GROUPE+"</option>"
            $("#listGroup").append(s)

        })
            })
    })
    
})
