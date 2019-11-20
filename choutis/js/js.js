var ctboxs=document.getElementById('ct1');
var ctbox=ctboxs.getElementsByClassName('ctbox');
var title=ctboxs.getElementsByClassName('title');
var contentHeight=470;
var titleWidth=60;
var n=0;
for(var i=0;i<title.length;i++){
    title[i].index=i;
    title[i].onclick=function(){
        n=this.index;
        for(var i=0;i<ctbox.length;i++){
            if(i<= n){
                ctbox[i].style.top=i*titleWidth+'px';
            }else{
                ctbox[i].style.top=i*titleWidth+contentHeight+'px';
            }
        }
    }
}