fixMozillaZIndex=true; //Fixes Z-Index problem  with Mozilla browsers but causes odd scrolling problem, toggle to see if it helps
_menuCloseDelay=500;
_menuOpenDelay=150;
_subOffsetTop=2;
_subOffsetLeft=-2;




with(menuStyle=new mm_style()){
styleid=1;
fontfamily="Verdana, Tahoma, Arial";
fontsize="10pt";
fontweight="bold";
headerbgcolor="#ffffff";
headercolor="#000000";
offcolor="#ffffff";
oncolor="#000000";
outfilter="fade(duration=0.5)";
pagecolor="black";
rawcss="padding-top:4px;padding-bottom:1px";
separatorcolor="#FFFFFF";
separatorheight=16;
separatorsize=1;
}

with(submenuStyle=new mm_style()){
bordercolor="#CDCDCD";
borderwidth=1;
fontfamily="Verdana, Tahoma, Arial";
fontsize="8pt";
fontweight="normal";
headercolor="#000000";
offbgcolor="#E9E9E9";
offcolor="#000000";
onbgcolor="#ffffff";
oncolor="#747A75";
outfilter="fade(duration=0.5)";
padding=5;
pagecolor="black";
subimage="http://img.milonic.com/9x6_rightbend_grey.gif";
subimagepadding=8;
}

with(milonic=new menuname("Main Menu")){
alwaysvisible=1;
itemheight=21;
itemwidth=126;
orientation="horizontal";
style=menuStyle;
aI("align=center;bgimage=http://img.milonic.com/itemblue.gif;overbgimage=http://img.milonic.com/itemyellow_on.gif;text=HOME;url=http://www.milonic.com/;");
aI("align=center;bgimage=http://img.milonic.com/itemblue.gif;overbgimage=http://img.milonic.com/itemorange_on.gif;showmenu=Milonic;text=MILONIC;");
aI("align=center;bgimage=http://img.milonic.com/itemblue.gif;overbgimage=http://img.milonic.com/itemcoral_on.gif;showmenu=Partners;text=PARTNERS;");
aI("align=center;bgimage=http://img.milonic.com/itemblue.gif;overbgimage=http://img.milonic.com/itemviolet_on.gif;showmenu=Links;text=LINKS;");
aI("align=center;bgimage=http://img.milonic.com/itemblue.gif;overbgimage=http://img.milonic.com/itemblue_on.gif;showmenu=MyMilonic;text=MYMILONIC;");
aI("align=center;bgimage=http://img.milonic.com/itemblue.gif;overbgimage=http://img.milonic.com/itemgreen_on.gif;text=SEARCH;");
}

with(milonic=new menuname("Milonic")){
itemheight=24;
itemwidth=126;
style=submenuStyle;
aI("text=Purchasing Page;url=http://www.milonic.com/cbuy.php;");
aI("text=Contact Us;url=http://www.milonic.com/contactus.php;");
aI("text=Newsletter Subscription;url=http://www.milonic.com/newsletter.php;");
aI("text=FAQ;url=http://www.milonic.com/menufaq.php;");
aI("text=Discussion Forum;url=http://www.milonic.com/forum/;");
aI("text=Software License Agreement;url=http://www.milonic.com/license.php;");
aI("text=Privacy Policy;url=http://www.milonic.com/privacy.php;");
}

with(milonic=new menuname("Partners")){
itemheight=24;
itemwidth=126;
style=submenuStyle;
aI("text=(aq) Hosting;url=http://www.a-q.co.uk/;");
aI("text=SMS 2 Email;url=http://www.sms2email.com/;");
aI("text=WebSmith;url=http://www.softidiom.com/?milonicmenu;");
}

with(milonic=new menuname("Links")){
itemheight=24;
itemwidth=126;
style=submenuStyle;
aI("text=Apache Server;url=http://www.apache.org/;");
aI("text=MySQL Database Server;url=http://ww.mysql.com/;");
aI("text=PHP - Development;url=http://www.php.net/;");
aI("text=phpBB Web Forum System;url=http://www.phpbb.net/;");
aI("showmenu=Anti Spam;text=Anti Spam;");
}

with(milonic=new menuname("Anti Spam")){
itemheight=24;
itemwidth=126;
style=submenuStyle;
aI("text=Spam Cop;url=http://www.spamcop.net/;");
aI("text=Mime Defang;url=http://www.mimedefang.org/;");
aI("text=Spam Assassin;url=http://www.spamassassin.org/;");
}

with(milonic=new menuname("MyMilonic")){
itemheight=24;
itemwidth=126;
style=submenuStyle;
aI("text=Login;url=http://www.milonic.com/login.php;");
aI("text=Licenses;url=http://www.milonic.com/mylicenses.php;");
aI("text=Invoices;url=http://www.milonic.com/myinvoices.php;");
aI("text=Make Support Request;url=http://www.milonic.com/reqsupport.php;");
aI("text=View Support Requests;url=http://www.milonic.com/mysupport.php;");
aI("text=Your Details;url=http://www.milonic.com/mydetails.php;");
}

drawMenus();


