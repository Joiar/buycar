   // var submit=document.getElementsByClassName('fm-btn')[0];
    var warmName=document.getElementsByClassName('warm-name')[0];
    var warmPhone=document.getElementsByClassName('warm-phone')[0];
    var submit=document.getElementById('submit');
    var btnBottom=document.getElementsByClassName('foot-btn')[0];
    
  
    // 
    function checkName(){ 
    var name = document.getElementById('Name').value.trim(); 
    var name1 = document.getElementById("Name").value;
    var i=0;
     if(name.length==0){    
       warmName.style.color='red';
 
    submit.onclick=function check(){ 
 
       return false;     
       }
      
     }  
     
    if(name.length>0){
    if((/^[0-9]*$/.test(name1))){
       
        warmName.innerHTML="姓名不能为数字";
        warmName.style.color="red";
    }  
    
     submit.onclick=function check(){ 
 
          return false;  
       }
   
    
    }  
    
   if(!(/^[0-9]*$/.test(name1))){

    setTimeout(function(){i+=1;warmName.innerHTML="输入正确√";warmName.style.color="#f15c08";},100);
    submit.onclick=function check(){ 
 
          return true;  
       } 
     
   }
 } 
   // 


     // 


  function checkPhone(){ 
   var phone = document.getElementById('phone').value.trim(); 
    var phone1 = document.getElementById("phone").value;
      var i=0;
     if(phone.length==0){    
        
      setTimeout(function(){i+=1;warmPhone.style.color="red";},100);
        submit.onclick=function check(){ 
 
          return false;  
       }
     }  
     
    if(phone.length>0){
    if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone1))){
      setTimeout(function(){i+=1;warmPhone.innerHTML="请输入正确的手机号码";warmPhone.style.color="red";},100);
        submit.onclick=function check(){ 
 
          return false;  
       }
       

    }   
     
   
    }  
    
   if((/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone1))){
   
    setTimeout(function(){i+=1;warmPhone.innerHTML="输入正确√";warmPhone.style.color="#f15c08";},100);
    submit.onclick=function check(){ 
 
          return true;  
       }
     
   }
 }

   
  // 



 function firstcheck(){
   if(name.length==0){
   submit.onclick=function check(){ 
 
          return false;  
       }
    
     } 
    if(phone.length==0){
      submit.onclick=function check(){ 
 
          return false;  
       } 
      
  }
 }
firstcheck();










