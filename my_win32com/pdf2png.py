from __future__ import division
from __future__ import unicode_literals

import os, sys, shutil, re, codecs
import win32com.client
from subprocess import Popen, PIPE 
from PIL import Image

GS_CMD = r'C:\Program Files\my\apps\Ghostscript\bin\gswin32c.exe'

pn = os.path.abspath(os.path.dirname(__file__))
if len(sys.argv) == 1:
    fn = raw_input('Export which file? ')
else:
    fn = sys.argv[1]
bn = os.path.splitext(fn)[0]   
fp = os.path.join(pn, fn)

if os.path.isdir(bn):
    shutil.rmtree(bn)
os.mkdir(bn)

cmd = [GS_CMD,
'-q',
'-dBATCH',
'-dNOPAUSE',
'-sDEVICE=png16m',
'-r300',
'-dTextAlphaBits=4',
'-dGraphicsAlphaBits=4',
r'-sOutputFile={}\Slide%03d.png'.format(bn),
fn,
]
p = Popen(cmd,stdout=PIPE,stderr=PIPE)
out, err = p.communicate()
