var ctboxs=document.getElementById('ct1');
var ctbox=ctboxs.getElementsByClassName('ctbox');
var title=ctboxs.getElementsByClassName('title');
var contentWidth=590;
var titleWidth=60;
for(var i=0;i<title.length;i++){
   
    title[i].index=i;
    title[i].onclick=function(){
        n=this.index;
        for(var i=0;i<ctbox.length;i++){
            if(i<= n){
                ctbox[i].style.left=i*titleWidth+'px';
            }else{
                ctbox[i].style.left=i*titleWidth+contentWidth+'px';
            }
            
        }
    }
}


//点击序号记为n则
// ctbox序号小于等于n的时候
// ctbox的left值计算公式为序号*titleWidth
// ctbox序号大于n的时候
// ctbox的left值计算公式为序号*titleWidth+contentWidth