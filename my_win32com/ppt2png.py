from __future__ import division

import os, sys, re
import win32com.client

import msoff, msppt
g = globals()
for c in dir(msoff.constants): g[c] = getattr(msoff.constants, c)
for c in dir(msppt.constants): g[c] = getattr(msppt.constants, c)

Application = win32com.client.Dispatch('PowerPoint.Application')
Application.Visible = True

pn = os.path.abspath(os.path.dirname(__file__))
if len(sys.argv) == 1:
    fn = raw_input('Export which file?')
else:
    fn = sys.argv[1]
bn = os.path.splitext(fn)[0]   
fp = os.path.join(pn, fn)

Presentation = Application.Presentations.Open(r'%s' % fp)
for Slide in Presentation.Slides:
    ImageName = '%s (%s) %s' % (bn, Slide.SlideIndex, Slide.Shapes.Title.TextFrame.TextRange.Text)
    ImageName = re.sub('[^-a-zA-Z0-9_() ]+', '', ImageName) # slugify
    ImageName += '.png'
    ImagePath = os.path.join(pn, ImageName)
    Slide.Export(ImagePath, 'png', 720, 540)

Application.Quit()