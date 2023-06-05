#!/usr/bin/env python
import logging
import requests
from xml.etree import ElementTree

from telegram import ForceReply, Update
from telegram.ext import Application, CommandHandler, ContextTypes, MessageHandler, filters

logging.basicConfig(format="%(asctime)s - %(name)s - %(levelname)s - %(message)s", level=logging.INFO)
logger = logging.getLogger(__name__)

async def start(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    user = update.effective_user
    await update.message.reply_html(
        rf"{user.mention_html()} عزیز، خوش اومدی\n برای دریافت بیت، کافیه اسم شاعر رو بفرستی. هر پیامی به جز اسم شاعر، یک بیت تصادفی برات میاره :) \n اگر پیام خالی برات اومد، مشکل از سرور سایت گنجور هست، کافیه دوباره امتحان کنی",      
        reply_markup=ForceReply(selective=True),
    )

async def get_random_poem(update: Update, context: ContextTypes.DEFAULT_TYPE) -> None:
    response = requests.get("http://c.ganjoor.net/beyt-xml.php?p=40&a=1")
    tree = ElementTree.fromstring(response.content)[0]
    msg = ""
    for poem in tree[0]:
        msg = msg + '\n' + poem.text
    msg += f"\n[{tree[1].text}]({tree[2].text})"
    msg += "\n@MeykhooneBot"
    await update.message.reply_text(msg, parse_mode='MarkdownV2')


def main() -> None:
    application = Application.builder().token("TOKEN").build()

    application.add_handler(CommandHandler("start", start))

    application.add_handler(MessageHandler(filters.TEXT & ~filters.COMMAND, get_random_poem))

    application.run_polling()


if __name__ == "__main__":
    main()