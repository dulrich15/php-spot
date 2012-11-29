from __future__ import division

import os, sys, hashlib
from datetime import datetime
import win32com.client

import msoff, msppt
g = globals()
for c in dir(msoff.constants): g[c] = getattr(msoff.constants, c)
for c in dir(msppt.constants): g[c] = getattr(msppt.constants, c)

Application = win32com.client.Dispatch('PowerPoint.Application')
Application.Visible = True

pn = os.path.abspath(os.path.dirname(__file__))

if len(sys.argv) > 1:
    fn = os.path.join(pn, sys.argv[1])
    Presentation = Application.Presentations.Open(r'%s' % fn)
    fn = os.path.splitext(fn)[0]
else:
    Presentation = Application.Presentations.Add()
    fn = hashlib.sha1(str(datetime.time(datetime.now()))).hexdigest()

Slide = Presentation.Slides.Add(Presentation.Slides.Count + 1, ppLayoutBlank)
Slide.Name = 'NewSlide'

Slide = Presentation.Slides('NewSlide')

Slide.Layout = ppLayoutText
Slide.FollowMasterBackground = msoFalse
Slide.Background.Fill.PresetGradient(msoGradientDiagonalDown, 1, msoGradientFog)

Slide.Shapes.Title.TextFrame.TextRange.Text = 'Hello World'
Slide.Shapes(2).TextFrame.TextRange.Text = '\r\n'.join(['Line 1','Line 2','Line 3'])
Slide.Shapes(2).TextFrame.TextRange.Font.Name = 'Arial'

Shape = Slide.Shapes.AddShape(msoShapeRectangle, 600, 420, 100, 100) # Left, Top, Width, Height
Shape.TextFrame.TextRange.Text = ':)'

Slide.Select

Presentation.SaveAs(os.path.join(pn, fn + '2'))

# Application.Quit()