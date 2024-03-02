const app = document.getElemtnByID('typewriter');

const typewriter = new typewriter
(app, { 
	loop:true,
	delay:75
	})

typewriter
.typestring('DevTB aprende picando codigo')
.pausefor(200)
.start();