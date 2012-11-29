import win32com.client

import msoff, msppt

g = globals()
for c in dir(msoff.constants): g[c] = getattr(msoff.constants, c)
for c in dir(msppt.constants): g[c] = getattr(msppt.constants, c)

# o = win32com.client.Dispatch("Excel.Application")
# o.Visible = 1
# o.Workbooks.Add() # for office 97 ? 95 a bit different!
# o.Cells(1,1).Value = "Hello"


# Open PowerPoint
Application = win32com.client.Dispatch("PowerPoint.Application")
Application.Visible = True
# Create new presentation
Presentation = Application.Presentations.Add()
# Add a blank slide
# # # Slide = Presentation.Slides.Add(1, 12)
Slide = Presentation.Slides.Add(1, ppLayoutBlank)
Slide.Shapes.AddShape(msoShapeRectangle, 100, 100, 200, 200)

Presentation.SaveAs(r"C:\Documents and Settings\u17864\Desktop\test2.ppt")


