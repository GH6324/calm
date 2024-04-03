import './css/tailwind.css'
import './css/main.css'
import Prism from "prismjs"//导入代码高亮插件的core（里面提供了其他官方插件及代码高亮样式主题，你只需要引入即可）
import "prismjs/themes/prism-tomorrow.min.css"//引入代码高亮主题（这个去node_modules的安装prismjs中找到想使用的主题即可）

window.onload = () => {
    document.querySelector("#mobile-menu-btn").addEventListener("click", () => {
        toggleMobileMenu();
    });
    document.querySelector("#mobile-menus-bg").addEventListener("click", () => {
        toggleMobileMenu();
    });

}

export function toggleMobileMenu() {
    const isHide = document.querySelector("#mobile-menus-bg").classList.contains("hidden");
    if (!isHide) {
        document.querySelector("#mobile-menus-bg")?.classList.add("hidden");
        document.querySelector("#mobile-menus")?.classList.add("hidden");
        document.querySelector("#mobile-menus")?.classList.remove("!translate-x-0");
    } else {
        document.querySelector("#mobile-menus-bg")?.classList.remove("hidden");
        document.querySelector("#mobile-menus")?.classList.remove("hidden");
        document.querySelector("#mobile-menus")?.classList.add("!translate-x-0");
    }
}

Prism.highlightAll();