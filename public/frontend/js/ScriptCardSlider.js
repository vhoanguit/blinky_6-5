
const listcard=[...document.querySelectorAll('.carousel')];
const nxtbtn=[...document.querySelectorAll('.nxt-btn')];
const prebtn=[...document.querySelectorAll('.pre-btn')];

listcard.forEach((item,i)=>{
    let current=0;
    let length=item.getElementsByClassName('product_card').length;
    
    nxtbtn[i].addEventListener('click', ()=>
    {
        if(current!=2)
        {
            current++;
            let width= item.offsetWidth;
            item.scrollLeft=width*current;
            
        }
        else
        {
            current=0;
            item.scrollLeft=0;  
        }
    });
    prebtn[i].addEventListener('click', ()=>
    {
        current--;
        let width= item.offsetWidth;
        item.scrollLeft=width*current;
    });

})