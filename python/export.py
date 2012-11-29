from __future__ import division

import os, sys
import win32com.client

import msoff, msppt
g = globals()
for c in dir(msoff.constants): g[c] = getattr(msoff.constants, c)
for c in dir(msppt.constants): g[c] = getattr(msppt.constants, c)

Application = win32com.client.Dispatch('PowerPoint.Application')
# Application.Visible = True

pn = os.path.abspath(os.path.dirname(__file__))
fn = os.path.join(pn, sys.argv[1])

# Presentation = Application.Presentations.Open(r'%s' % fn)
Presentation = Application.Presentations.Add()

Slide = Presentation.Slides.Add(Presentation.Slides.Count + 1, ppLayoutBlank)
Slide.Name = 'NewSlide'

Slide = Presentation.Slides('NewSlide')

Slide.Layout = ppLayoutText
Slide.FollowMasterBackground = msoFalse
Slide.Background.Fill.PresetGradient(msoGradientDiagonalDown, 1, msoGradientFog)

Slide.Shapes.Title.TextFrame.TextRange.Text = 'Hello World'
Slide.Shapes(2).TextFrame.TextRange.Text = '\n'.join(['Line 1','Line 2','Line 3'])

Shape = Slide.Shapes.AddShape(msoShapeRectangle, 600, 420, 100, 100) # Left, Top, Width, Height
Shape.TextFrame.TextRange.Text = ":)"

Slide.Select

for Slide in Presentation.Slides:
    x = (Slide.Name, Slide.Shapes.Title.TextFrame.TextRange)
    ImageName = '%s -- %s.png' % x
    ImagePath = os.path.join(pn, ImageName)
    Slide.Export(ImagePath, 'png', 720, 540)

# Presentation.SaveAs(os.path.join(pn, fn + '2'))
Application.Quit()