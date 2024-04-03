window.onload = () => {
    console.log('is in')
    // *************功能一：生成目录******************************
    var eles = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']
    // 获取文章里 h1 到 h6 的元素
    var doms = document.querySelector('#content').querySelectorAll(eles.toString());
    console.log(doms)
    if (!doms || !doms.length) {
        return;
    }
    // 创建目录盒子
    let ul = document.createElement('ul');
    ul.setAttribute('class', 'hidden xl:block xl:fixed top-0 right-0 w-60 mr-5 mt-5 list-decimal');
    let li = document.createElement('div');
    li.setAttribute('class','font-bold');
    
    let liText = document.createTextNode('内容导航目录');    
    li.appendChild(liText)

    ul.appendChild(li);
    // 目录的下标
    let index = 0
    for (let h of doms) {
        let tag = h.nodeName.toLowerCase()
        if (!eles.includes(tag)) {
            continue;
        }

        // 生成每个目录的id，绑定在 h 标签上
        let id = `catalog_${++index}`
        h.setAttribute('id', id)
        // 获取 h 标签的内容
        let text = h.innerHTML.replace(/<\/?[^>]+>/g, '')
        // 生成 li 元素，需要绑定h 的id，以便于点击目录时可以找到对应的 h 标签
        let li = document.createElement('li');
        li.setAttribute('catalog', id)
        li.classList.add('cursor-pointer');
        //li.classList.add('truncate');

        let childDiv = document.createElement('div');
        childDiv.classList.add('truncate');
        let liText = document.createTextNode(text);
        childDiv.appendChild(liText);

        li.appendChild(childDiv)

        ul.appendChild(li);
    }
    document.body.appendChild(ul)

    // *************功能二：点击目录滚动到对应区域******************************
    for (const item of document.querySelectorAll('li[catalog]')) {
        item.addEventListener('click', function (e) {
            let id = e.currentTarget.getAttribute('catalog');
            document.querySelector(`#${id}`).scrollIntoView({
                behavior: 'smooth'
            })
        })
    }

    // *************功能三：目录跟随滚动高亮******************************
    window.addEventListener('scroll', function () {
        // 获取浏览器滚动条距离顶部的高度
        let scroll = document.documentElement.scrollTop || document.body.scrollTop

        for (let i = doms.length - 1; i >= 0; i--) {
            // 倒叙遍历所有的 h 标签，如果滚动条的 scrollTop 刚刚大于 h 区域的 offsetTop，
            // 将此h 标签对应的 目录 设置为高亮
            if (parseInt(scroll) >= Math.ceil(doms[i].offsetTop)) {
                let id = doms[i].getAttribute('id');
                for (const item of document.querySelectorAll('li[catalog]')) {

                    if (item.getAttribute('catalog') === id) {
                        item.classList.add('underline');
                        item.classList.add('underline-offset-4');
                        item.classList.add('decoration-emerald-600');
                        item.classList.add('text-[#00b894]');
                    } else {
                        item.classList.remove('underline');
                        item.classList.remove('underline-offset-4');
                        item.classList.remove('decoration-emerald-600');
                        item.classList.remove('text-[#00b894]');
                    }
                }
                break;
            }
        }
    })
}