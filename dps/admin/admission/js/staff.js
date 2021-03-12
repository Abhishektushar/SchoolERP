 let orderButton = document.getElementById("Save");
        let itemList = document.getElementById("AssignedClass");
        let outputBox = document.getElementById("output");

        orderButton.addEventListener("click", function() {
          let collection = itemList.selectedOptions;
          let output = "";

          for (let i=0; i<collection.length; i++) {
            if (output === "") {
              output = "You are assigning the following classes: ";
            }
            output += collection[i].label;

            if (i === (collection.length - 2) && (collection.length < 3)) {
              output +=  " and ";
            } else if (i < (collection.length - 2)) {
              output += ", ";
            } else if (i === (collection.length - 2)) {
              output += ", and ";
            }
          }

          if (output === "") {
            output = "You didn't assign anything!";
          }

          outputBox.innerHTML = output;
        }, false);

        
        //additional educational detals ADD
        $(document).ready(function(){
        $('#doCheck').change(function(){
        if(this.checked)
        $('#showMore').show();
        else
        $('#showMore').hide();

        });
        });
        
        function resetFunction() {        
          var ask = confirm("Are you sure You want to reset?");
          if (ask == true) {
            document.getElementById("staffForm").reset();
            document.documentElement.scrollTop = 0;
          } else {
             document.documentElement.scrollTop = 0;
          }
        }
        
    function showSelect(divId, element)
        {
            var result;
            if(element.value == 'Teacher'){
                result = 'block';
            }else if (element.value == 'Lab Assistant'){
                result = 'block';
            }else{
                result = 'none';
            }
            document.getElementById(divId).style.display = result;
        }    
        
     function showClass(divId)
        {
            document.getElementById(divId).style.display = 'block';
        }    
        
        
     function showSubAssigned(divId, element)
        {
            var outcome;
            if(element.value == 'Librarian'){
                outcome = 'none';
            }else {
                outcome='block';
            }
            document.getElementById(divId).style.display = outcome;
         }    
        
  //option changing function
        $(document).ready(function () {
            $("#gender").change(function () {
                var val = $(this).val();
                if (val == "Male") {
                    $("#relation").html("<option value='Son Of'>Son Of</option>");
                } else if (val == "Female") {
                    $("#relation").html("<option value=''>---Select One---</option><option value='Daughter Of'>Daughter Of</option><option value='Wife Of'>Wife Of</option>");
                } else if (val == "") {
                    $("#relation").html("<option value=''>---Select One---</option>");
                }
            });
        });
        
        
        $(document).ready(function () {
            $("#staff").change(function () {
                var val = $(this).val();
                if (val === "Teacher") {
                                        $("#PostType").html("<option value=''>---Select One---</option><option value='Asst. Teacher'>Asst. Teacher</option><option value='Music Teacher'>Music Teacher</option><option value='Art Teacher'>Art Teacher</option><option value='Sports Teacher'>Sports Teacher</option><option value='Librarian'>Librarian</option>");
                } else if (val === "Warden") {
                                        $("#PostType").html("");
                } else if (val === "Lab Assistant") {
                                        $("#PostType").html("<option value=''>---Select One---</option><option value='Physics Lab'>Physics Lab</option><option value='Chemistry Lab'>Chemistry Lab</option><option value='Biology Lab'>Biology Lab</option><option value='Computer Lab'>Computer Lab</option>");
                }else if (val === "Transport Officer") {
                                        $("#PostType").html("");
                }else if (val === "") {
                                        $("#PostType").html("<option value=''>---Select One---</option>");
                }
            });
        });
        
        
         $(document).ready(function () {
            $("#PostType").change(function () {
                var val = $(this).val();
                if (val == "Asst. Teacher") {
                                        $("#AssignSubject").html("<option value=''>---Select One---</option><option value='Science'>Science&#40;All&#41;</option><option value='Physics'>Science&#40;Physics&#41;</option><option value='Chemistry'>Science&#40;Chemistry&#41;</option><option value='Biology'>Science&#40;Biology&#41;</option><option value='Maths'>Maths</option><option value='English'>English</option><option value='Hindi'>Hindi</option><option value='Computer'>Computer</option><option value='Social Science'>Social Science&#40;All&#41;</option><option value='History'>Social Science&#40;History&#41;</option><option value='Geography'>Social Science&#40;Geography&#41;</option><option value='Economics'>Social Science&#40;Economics&#41;</option><option value='Civics'>Social Science&#40;Civics&#41;</option>");
                } else if (val == "Music Teacher") {
                                        $("#AssignSubject").html("<option value='Music'>Music</option>");
                } else if (val == "Art Teacher") {
                                        $("#AssignSubject").html("<option value='Art'>Art</option>");
                }else if (val == "Sports Teacher") {
                                        $("#AssignSubject").html("<option value='Games'>Games</option>");
               
                 }else if (val == "Physics Lab") {
                                        $("#AssignSubject").html("<option value='Physics'>Science&#40;Physics&#41;</option>");
                 }else if (val == "Chemistry Lab") {
                                        $("#AssignSubject").html("<option value='Chemistry'>Science&#40;Chemistry&#41;</option>");
                 }else if (val == "Biology Lab") {
                                        $("#AssignSubject").html("<option value='Biology'>Science&#40;Biology&#41;</option>");
                }else if (val == "Computer Lab") {
                                        $("#AssignSubject").html("<option value='Computer'>Computer</option>");     
                    
                }else if (val == "") {
                                        $("#AssignSubject").html("<option value=''>---Select One---</option>");
                }   else{
                    $("#AssignSubject").html("<option value=''>---Select One---</option>");
                }
            });
        });
        
 

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
